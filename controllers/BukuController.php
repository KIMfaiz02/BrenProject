<?php

require_once __DIR__ . '/../models/Buku.php';

class BukuController
{
    private Buku $bukuModel;

    public function __construct()
    {
        $this->bukuModel = new Buku();
    }

    public function index(): void
    {
        $data_buku = $this->bukuModel->getAll()->fetch_all(MYSQLI_ASSOC);
        include __DIR__ . '/../views/buku/index.php';
    }

    public function tambah($id = null): void
    {
        $pesan_error = '';
        $buku = [
            'kode_buku' => '',
            'judul_buku' => '',
            'penulis' => '',
            'penerbit' => '',
            'tahun_terbit' => '',
            'stok' => 1,
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $buku = $this->ambilInputBuku();
            if (!$this->inputBukuValid($buku)) {
                $pesan_error = 'Semua data wajib diisi dan stok harus berupa bilangan bulat nol atau lebih.';
            } else {
                try {
                    $this->bukuModel->create(
                        $buku['kode_buku'],
                        $buku['judul_buku'],
                        $buku['penulis'],
                        $buku['penerbit'],
                        (int) $buku['tahun_terbit'],
                        (int) $buku['stok']
                    );
                    header('Location: index.php?content=buku');
                    exit;
                } catch (Throwable $error) {
                    $pesan_error = 'Gagal menyimpan buku. Pastikan kode buku belum digunakan.';
                }
            }
        }

        include __DIR__ . '/../views/buku/tambah.php';
    }

    public function edit($id = null): void
    {
        $id = (int) $id;
        $buku = $this->bukuModel->getById($id);
        if ($buku === null) {
            http_response_code(404);
            exit('Buku tidak ditemukan.');
        }

        $pesan_error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = $this->ambilInputBuku();
            if (!$this->inputBukuValid($input)) {
                $pesan_error = 'Semua data wajib diisi dan stok harus berupa bilangan bulat nol atau lebih.';
            } else {
                try {
                    $this->bukuModel->update(
                        $id,
                        $input['kode_buku'],
                        $input['judul_buku'],
                        $input['penulis'],
                        $input['penerbit'],
                        (int) $input['tahun_terbit'],
                        (int) $input['stok']
                    );
                    header('Location: index.php?content=buku');
                    exit;
                } catch (Throwable $error) {
                    $pesan_error = 'Gagal mengubah buku. Pastikan kode buku belum digunakan.';
                }
            }
            $buku = array_merge($buku, $input);
        }

        include __DIR__ . '/../views/buku/edit.php';
    }

    public function hapus($id = null): void
    {
        try {
            $this->bukuModel->delete((int) $id);
        } catch (Throwable $error) {
            header('Location: index.php?content=buku&message=Buku+masih+terkait+dengan+peminjaman');
            exit;
        }

        header('Location: index.php?content=buku');
        exit;
    }

    private function ambilInputBuku(): array
    {
        return [
            'kode_buku' => trim($_POST['kode_buku'] ?? ''),
            'judul_buku' => trim($_POST['judul_buku'] ?? ''),
            'penulis' => trim($_POST['penulis'] ?? ''),
            'penerbit' => trim($_POST['penerbit'] ?? ''),
            'tahun_terbit' => trim($_POST['tahun_terbit'] ?? ''),
            'stok' => trim($_POST['stok'] ?? '0'),
        ];
    }

    private function inputBukuValid(array $buku): bool
    {
        return $buku['kode_buku'] !== ''
            && $buku['judul_buku'] !== ''
            && $buku['penulis'] !== ''
            && $buku['penerbit'] !== ''
            && filter_var($buku['tahun_terbit'], FILTER_VALIDATE_INT) !== false
            && filter_var($buku['stok'], FILTER_VALIDATE_INT) !== false
            && (int) $buku['stok'] >= 0;
    }
}