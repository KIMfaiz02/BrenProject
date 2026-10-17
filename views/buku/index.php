<?php $data_buku = $data_buku ?? []; ?>
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Data Buku</title>

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
                href="index.php?content=anggota"
                class="btn btn-outline-light btn-sm">

                Anggota

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
                Data Buku
            </h2>

            <p class="text-muted">
                Daftar buku perpustakaan
            </p>

        </div>

        <a
            href="index.php?content=tambah_buku"
            class="btn btn-primary">

            + Tambah Buku

        </a>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-primary">

                    <tr>

                        <th>No</th>
                        <th>Kode Buku</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th>Aksi</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php if (count($data_buku) > 0): ?>

                        <?php $nomor = 1; ?>

                        <?php foreach ($data_buku as $buku): ?>

                            <tr>

                                <td>
                                    <?= $nomor++; ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($buku['kode_buku']); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($buku['judul_buku']); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($buku['penulis']); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($buku['penerbit']); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($buku['tahun_terbit']); ?>
                                </td>

                                <td>
                                    <?= (int) $buku['stok']; ?>
                                </td>

                                <td>

                                    <a
                                        href="index.php?content=edit_buku&id=<?= (int) $buku['id']; ?>"
                                        class="btn btn-warning btn-sm">

                                        Edit

                                    </a>

                                    <a
                                        href="index.php?content=hapus_buku&id=<?= (int) $buku['id']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus buku ini?');">

                                        Hapus

                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td
                                colspan="8"
                                class="text-center text-muted">

                                Belum ada data buku.

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

