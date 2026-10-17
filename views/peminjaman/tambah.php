<?php
$pesan_error = $pesan_error ?? '';
$tanggal_pinjam = $tanggal_pinjam ?? date('Y-m-d');
$id_buku = $id_buku ?? 0;
$id_anggota = $id_anggota ?? 0;
$data_buku = $data_buku ?? [];
$data_anggota = $data_anggota ?? [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a href="index.php" class="navbar-brand fw-bold">Perpustakaan</a>
        <a href="index.php?content=peminjaman" class="btn btn-light btn-sm">Kembali ke Peminjaman</a>
    </div>
</nav>
<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <section class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h3 mb-4">Tambah Peminjaman</h1>
                    <?php if ($pesan_error !== ''): ?>
                        <div class="alert alert-danger" role="alert"><?= htmlspecialchars($pesan_error, ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php endif; ?>
                    <form method="post" action="index.php?content=peminjaman&amp;action=tambah">
                        <div class="mb-3">
                            <label for="id_buku" class="form-label">Buku tersedia</label>
                            <select id="id_buku" name="id_buku" class="form-select" required>
                                <option value="">Pilih buku</option>
                                <?php foreach ($data_buku as $buku): ?>
                                    <option value="<?= (int) $buku['id']; ?>" <?= $id_buku === (int) $buku['id'] ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($buku['judul_buku'], ENT_QUOTES, 'UTF-8'); ?> (stok: <?= (int) $buku['stok']; ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="id_anggota" class="form-label">Anggota</label>
                            <select id="id_anggota" name="id_anggota" class="form-select" required>
                                <option value="">Pilih anggota</option>
                                <?php foreach ($data_anggota as $anggota): ?>
                                    <option value="<?= (int) $anggota['id']; ?>" <?= $id_anggota === (int) $anggota['id'] ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($anggota['nama'], ENT_QUOTES, 'UTF-8'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="tanggal_pinjam" class="form-label">Tanggal pinjam</label>
                            <input id="tanggal_pinjam" type="date" name="tanggal_pinjam" class="form-control" value="<?= htmlspecialchars($tanggal_pinjam, ENT_QUOTES, 'UTF-8'); ?>" required>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="index.php?content=peminjaman" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Peminjaman</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</main>
</body>
</html>