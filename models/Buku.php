<?php

require_once __DIR__ . '/../koneksi.php';

class Buku
{
	private mysqli $db;

	public function __construct(?mysqli $db = null)
	{
		if ($db === null) {
			$database = new Koneksi();
			$db = $database->conn;
		}

		$this->db = $db;
	}

	public function kurangiStok(int $id): bool
	{
		$stmt = $this->db->prepare(
			'UPDATE buku SET stok = stok - 1 WHERE id = ? AND stok > 0'
		);
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$berhasil = $stmt->affected_rows === 1;
		$stmt->close();

		return $berhasil;
	}

	public function tambahStok(int $id): bool
	{
		$stmt = $this->db->prepare(
			'UPDATE buku SET stok = stok + 1 WHERE id = ?'
		);
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$berhasil = $stmt->affected_rows === 1;
		$stmt->close();

		return $berhasil;
	}

	public function getBukuTersedia(): mysqli_result
	{
		return $this->db->query(
			'SELECT * FROM buku WHERE stok > 0 ORDER BY judul_buku'
		);
	}

	public function getAll(): mysqli_result
	{
		return $this->db->query('SELECT * FROM buku ORDER BY id DESC');
	}

	public function getById(int $id): ?array
	{
		$stmt = $this->db->prepare('SELECT * FROM buku WHERE id = ?');
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$buku = $stmt->get_result()->fetch_assoc();
		$stmt->close();

		return $buku ?: null;
	}

	public function create(string $kode, string $judul, string $penulis, string $penerbit, int $tahun, int $stok): bool
	{
		$stmt = $this->db->prepare(
			'INSERT INTO buku (kode_buku, judul_buku, penulis, penerbit, tahun_terbit, stok)
			 VALUES (?, ?, ?, ?, ?, ?)'
		);
		$stmt->bind_param('ssssii', $kode, $judul, $penulis, $penerbit, $tahun, $stok);
		$berhasil = $stmt->execute();
		$stmt->close();

		return $berhasil;
	}

	public function update(int $id, string $kode, string $judul, string $penulis, string $penerbit, int $tahun, int $stok): bool
	{
		$stmt = $this->db->prepare(
			'UPDATE buku SET kode_buku = ?, judul_buku = ?, penulis = ?, penerbit = ?,
			 tahun_terbit = ?, stok = ? WHERE id = ?'
		);
		$stmt->bind_param('ssssiii', $kode, $judul, $penulis, $penerbit, $tahun, $stok, $id);
		$berhasil = $stmt->execute();
		$stmt->close();

		return $berhasil;
	}

	public function delete(int $id): bool
	{
		$stmt = $this->db->prepare('DELETE FROM buku WHERE id = ?');
		$stmt->bind_param('i', $id);
		$berhasil = $stmt->execute();
		$stmt->close();

		return $berhasil;
	}
}
