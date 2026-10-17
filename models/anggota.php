<?php

require_once __DIR__ . '/../koneksi.php';

class Anggota
{
    private mysqli $db;

    public function __construct()
    {
        $database = new Koneksi();
        $this->db = $database->conn;
    }

    public function getAll()
    {
        return $this->db->query("SELECT * FROM anggota");
    }

    public function getById(int $id)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM anggota WHERE id=?"
        );

        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function create(
        string $idAnggota,
        string $nama,
        string $alamat,
        string $noTelepon
    ) {
        $stmt = $this->db->prepare(
            "INSERT INTO anggota (id_anggota, nama, alamat, no_telepon)
             VALUES (?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "ssss",
            $idAnggota,
            $nama,
            $alamat,
            $noTelepon
        );

        return $stmt->execute();
    }

    public function update(
        int $id,
        string $idAnggota,
        string $nama,
        string $alamat,
        string $noTelepon
    ) {
        $stmt = $this->db->prepare(
            "UPDATE anggota
             SET id_anggota=?, nama=?, alamat=?, no_telepon=?
             WHERE id=?"
        );

        $stmt->bind_param(
            "ssssi",
            $idAnggota,
            $nama,
            $alamat,
            $noTelepon,
            $id
        );

        return $stmt->execute();
    }

    public function delete(int $id)
    {
        $stmt = $this->db->prepare(
            "DELETE FROM anggota WHERE id=?"
        );

        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}

?>