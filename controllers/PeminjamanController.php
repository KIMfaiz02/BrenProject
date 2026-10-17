<?php

require_once __DIR__ . '/../models/Peminjaman.php';
require_once __DIR__ . '/../models/anggota.php';

class PeminjamanController
{
    private Peminjaman $peminjamanModel;
    private Anggota $anggotaModel;

    public function __construct()
    {
        $this->peminjamanModel = new Peminjaman();
        $this->anggotaModel = new Anggota();
    }

    public function index(): void
    {
        $data_peminjaman = $this->peminjamanModel->getAll()->fetch_all(MYSQLI_ASSOC);
        include __DIR__ . '/../views/peminjaman/index.php';
    }

    public function tambah(): void
    {
        $pesan_error = '';
        $tanggal_pinjam = $_POST['tanggal_pinjam'] ?? date('Y-m-d');
        $id_buku = (int) ($_POST['id_buku'] ?? 0);
        $id_anggota = (int) ($_POST['id_anggota'] ?? 0);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->tanggalValid($tanggal_pinjam) || $id_buku <= 0 || $id_anggota <= 0) {
                $pesan_error = 'Tanggal, buku, dan anggota wajib dipilih dengan benar.';
            } else {
                try {
                    if ($this->peminjamanModel->create($id_buku, $id_anggota, $tanggal_pinjam)) {
                        header('Location: index.php?content=peminjaman&message=Peminjaman+berhasil+disimpan');
                        exit;
                    }
                    $pesan_error = 'Stok buku habis atau buku tidak tersedia.';
                } catch (Throwable $error) {
                    $pesan_error = 'Peminjaman gagal disimpan. Periksa data buku dan anggota.';
                }
            }
        }

        $data_buku = (new Buku())->getBukuTersedia()->fetch_all(MYSQLI_ASSOC);
        $data_anggota = $this->anggotaModel->getAll()->fetch_all(MYSQLI_ASSOC);
        include __DIR__ . '/../views/peminjaman/tambah.php';
    }

    public function edit($id = null): void
    {
        $peminjamanId = (int) ($id ?? 0);
        $tanggalKembali = $_POST['tanggal_kembali'] ?? date('Y-m-d');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $peminjamanId <= 0
            || !$this->tanggalValid($tanggalKembali)) {
            header('Location: index.php?content=peminjaman&message=Tanggal+kembali+tidak+valid');
            exit;
        }

        try {
            $berhasil = $this->peminjamanModel->kembalikan($peminjamanId, $tanggalKembali);
            $message = $berhasil
                ? 'Buku+berhasil+dikembalikan'
                : 'Peminjaman+tidak+ditemukan+atau+sudah+dikembalikan';
        } catch (Throwable $error) {
            $message = 'Pengembalian+buku+gagal+diproses';
        }

        header('Location: index.php?content=peminjaman&message=' . $message);
        exit;
    }

    private function tanggalValid(string $tanggal): bool
    {
        $date = DateTime::createFromFormat('!Y-m-d', $tanggal);
        return $date !== false && $date->format('Y-m-d') === $tanggal;
    }
}