<?php $data_anggota = $data_anggota ?? []; ?>
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Data Anggota</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">

    <div class="container">

        <a
            href="index.php"
            class="navbar-brand fw-bold">

            📚 Perpustakaan

        </a>

        <div>

            <a
                href="index.php"
                class="btn btn-light btn-sm">

                Beranda

            </a>

            <a
                href="index.php?content=buku"
                class="btn btn-outline-light btn-sm">

                Buku

            </a>

            <a
                href="index.php?content=peminjaman"
                class="btn btn-outline-light btn-sm">

                Peminjaman

            </a>

        </div>

    </div>

</nav>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">
                Data Anggota
            </h2>

            <p class="text-muted">
                Daftar anggota perpustakaan
            </p>

        </div>

        <a
            href="index.php?content=tambah_anggota"
            class="btn btn-primary">

            + Tambah Anggota

        </a>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-primary">

                    <tr>

                        <th>No</th>
                        <th>ID Anggota</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                        <th>Aksi</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php if (count($data_anggota) > 0): ?>

                        <?php $nomor = 1; ?>

                        <?php foreach ($data_anggota as $anggota): ?>

                            <tr>

                                <td>
                                    <?= $nomor++; ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($anggota['id_anggota']); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($anggota['nama']); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($anggota['alamat']); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($anggota['no_telepon']); ?>
                                </td>

                                <td>

                                    <a
                                        href="index.php?content=edit_anggota&id=<?= (int) $anggota['id']; ?>"
                                        class="btn btn-warning btn-sm">

                                        Edit

                                    </a>

                                    <a
                                        href="index.php?content=hapus_anggota&id=<?= (int) $anggota['id']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus anggota ini?');">

                                        Hapus

                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td
                                colspan="6"
                                class="text-center text-muted">

                                Belum ada data anggota.

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>
</html>