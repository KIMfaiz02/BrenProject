<?php $data_peminjaman = $data_peminjaman ?? []; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a href="index.php" class="navbar-brand fw-bold">Perpustakaan</a>
        <div class="d-flex gap-2">
            <a href="index.php" class="btn btn-light btn-sm">Beranda</a>
            <a href="index.php?content=buku" class="btn btn-outline-light btn-sm">Buku</a>
            <a href="index.php?content=anggota" class="btn btn-outline-light btn-sm">Anggota</a>
            <a href="index.php?content=peminjaman" class="btn btn-outline-light btn-sm">Peminjaman</a>
        </div>
    </div>
</nav>
<main class="container py-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h2 mb-1">Data Peminjaman</h1>
            <p class="text-muted mb-0">Pantau buku yang sedang dipinjam dan dikembalikan.</p>
        </div>
        <a href="index.php?content=peminjaman&action=tambah" class="btn btn-primary">+ Tambah Peminjaman</a>
    </div>

    <?php if (isset($_GET['message'])): ?>
        <div class="alert alert-info" role="status">
            <?= htmlspecialchars($_GET['message'], ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-primary">
                <tr>
                    <th>No.</th>
                    <th>Buku</th>
                    <th>Anggota</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php if (count($data_peminjaman) > 0): ?>
                    <?php $nomor = 1; ?>
                    <?php foreach ($data_peminjaman as $peminjaman): ?>
                        <tr>
                            <td><?= $nomor++; ?></td>
                            <td>
                                <strong><?= htmlspecialchars($peminjaman['judul_buku'], ENT_QUOTES, 'UTF-8'); ?></strong>
                                <div class="small text-muted"><?= htmlspecialchars($peminjaman['kode_buku'], ENT_QUOTES, 'UTF-8'); ?></div>
                            </td>
                            <td><?= htmlspecialchars($peminjaman['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($peminjaman['tanggal_pinjam'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($peminjaman['tanggal_kembali'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <span class="badge <?= $peminjaman['status'] === 'Dikembalikan' ? 'text-bg-success' : 'text-bg-warning'; ?>">
                                    <?= htmlspecialchars($peminjaman['status'], ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($peminjaman['status'] === 'Dipinjam'): ?>
                                    <form method="post" action="index.php?content=peminjaman&amp;action=edit&amp;id=<?= (int) $peminjaman['id']; ?>" class="d-flex gap-2">
                                        <input type="date" name="tanggal_kembali" class="form-control form-control-sm" value="<?= date('Y-m-d'); ?>" required aria-label="Tanggal kembali">
                                        <button type="submit" class="btn btn-success btn-sm">Kembalikan</button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-muted">Selesai</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="py-4 text-center text-muted">Belum ada data peminjaman.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
</body>
</html>