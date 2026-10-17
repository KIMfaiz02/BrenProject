<?php

require_once __DIR__ . '/../models/anggota.php';

class AnggotaController
{
    private Anggota $anggotaModel;

    public function __construct()
    {
        $this->anggotaModel = new Anggota();
    }

    public function index(): void
    {
        $data_anggota = $this->anggotaModel->getAll()->fetch_all(MYSQLI_ASSOC);
        include __DIR__ . '/../views/anggota/index.php';
    }

    public function tambah($id = null): void
    {
        $anggota = ['id_anggota' => '', 'nama' => '', 'alamat' => '', 'no_telepon' => ''];
        $pesan_error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $anggota = $this->ambilInputAnggota();
            if (!$this->inputAnggotaValid($anggota)) {
                $pesan_error = 'Semua data wajib diisi.';
            } else {
                try {
                    $this->anggotaModel->create(
                        $anggota['id_anggota'],
                        $anggota['nama'],
                        $anggota['alamat'],
                        $anggota['no_telepon']
                    );
                    header('Location: index.php?content=anggota');
                    exit;
                } catch (Throwable $error) {
                    $pesan_error = 'Gagal menyimpan anggota. Pastikan ID anggota belum digunakan.';
                }
            }
        }

        include __DIR__ . '/../views/anggota/tambah.php';
    }

    public function edit($id = null): void
    {
        $id = (int) $id;
        $anggota = $this->anggotaModel->getById($id);
        if ($anggota === null) {
            http_response_code(404);
            exit('Anggota tidak ditemukan.');
        }

        $pesan_error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = $this->ambilInputAnggota();
            if (!$this->inputAnggotaValid($input)) {
                $pesan_error = 'Semua data wajib diisi.';
            } else {
                try {
                    $this->anggotaModel->update(
                        $id,
                        $input['id_anggota'],
                        $input['nama'],
                        $input['alamat'],
                        $input['no_telepon']
                    );
                    header('Location: index.php?content=anggota');
                    exit;
                } catch (Throwable $error) {
                    $pesan_error = 'Gagal mengubah anggota.';
                }
            }
            $anggota = array_merge($anggota, $input);
        }

        include __DIR__ . '/../views/anggota/edit.php';
    }

    public function hapus($id = null): void
    {
        try {
            $this->anggotaModel->delete((int) $id);
        } catch (Throwable $error) {
            header('Location: index.php?content=anggota&message=Anggota+masih+terkait+dengan+peminjaman');
            exit;
        }

        header('Location: index.php?content=anggota');
        exit;
    }

    private function ambilInputAnggota(): array
    {
        return [
            'id_anggota' => trim($_POST['id_anggota'] ?? ''),
            'nama' => trim($_POST['nama'] ?? ''),
            'alamat' => trim($_POST['alamat'] ?? ''),
            'no_telepon' => trim($_POST['no_telepon'] ?? ''),
        ];
    }

    private function inputAnggotaValid(array $anggota): bool
    {
        return $anggota['id_anggota'] !== ''
            && $anggota['nama'] !== ''
            && $anggota['alamat'] !== ''
            && $anggota['no_telepon'] !== '';
    }
}