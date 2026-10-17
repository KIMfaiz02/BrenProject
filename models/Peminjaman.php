<?php

require_once __DIR__ . '/../koneksi.php';
require_once __DIR__ . '/Buku.php';

class Peminjaman
{
    private mysqli $db;
    private Buku $bukuModel;

    public function __construct()
    {
        $database = new Koneksi();
        $this->db = $database->conn;
        $this->bukuModel = new Buku($this->db);
    }

    public function getAll(): mysqli_result
    {
        return $this->db->query(
            'SELECT peminjaman.*, buku.judul_buku, buku.kode_buku, anggota.nama
             FROM peminjaman
             INNER JOIN buku ON buku.id = peminjaman.id_buku
             INNER JOIN anggota ON anggota.id = peminjaman.id_anggota
             ORDER BY peminjaman.id DESC'
        );
    }

    public function create(int $idBuku, int $idAnggota, string $tanggalPinjam): bool
    {
        $this->db->begin_transaction();

        try {
            if (!$this->bukuModel->kurangiStok($idBuku)) {
                $this->db->rollback();
                return false;
            }

            $stmt = $this->db->prepare(
                "INSERT INTO peminjaman (id_buku, id_anggota, tanggal_pinjam, status)
                 VALUES (?, ?, ?, 'Dipinjam')"
            );
            $stmt->bind_param('iis', $idBuku, $idAnggota, $tanggalPinjam);
            $stmt->execute();
            $stmt->close();
            $this->db->commit();

            return true;
        } catch (Throwable $error) {
            $this->db->rollback();
            throw $error;
        }
    }

    public function kembalikan(int $id, string $tanggalKembali): bool
    {
        $this->db->begin_transaction();

        try {
            $stmt = $this->db->prepare(
                'SELECT id_buku, status FROM peminjaman WHERE id = ? FOR UPDATE'
            );
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $peminjaman = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            if ($peminjaman === null || $peminjaman['status'] !== 'Dipinjam') {
                $this->db->rollback();
                return false;
            }

            $stmt = $this->db->prepare(
                "UPDATE peminjaman SET tanggal_kembali = ?, status = 'Dikembalikan'
                 WHERE id = ? AND status = 'Dipinjam'"
            );
            $stmt->bind_param('si', $tanggalKembali, $id);
            $stmt->execute();
            $stmt->close();

            if (!$this->bukuModel->tambahStok((int) $peminjaman['id_buku'])) {
                throw new RuntimeException('Stok buku tidak dapat diperbarui.');
            }

            $this->db->commit();
            return true;
        } catch (Throwable $error) {
            $this->db->rollback();
            throw $error;
        }
    }
}