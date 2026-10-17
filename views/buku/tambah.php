<?php
$buku = $buku ?? [
    'kode_buku' => '',
    'judul_buku' => '',
    'penulis' => '',
    'penerbit' => '',
    'tahun_terbit' => '',
    'stok' => 1,
];
$pesan_error = $pesan_error ?? '';
?>
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Tambah Buku</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow border-0">

                <div class="card-header bg-primary text-white">

                    <h4 class="mb-0">
                        Tambah Buku
                    </h4>

                </div>

                <div class="card-body">

                    <?php if ($pesan_error !== ''): ?>

                        <div class="alert alert-danger">

                            <?= htmlspecialchars($pesan_error); ?>

                        </div>

                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Kode Buku
                            </label>

                            <input
                                type="text"
                                name="kode_buku"
                                class="form-control"
                                value="<?= htmlspecialchars($buku['kode_buku'], ENT_QUOTES, 'UTF-8'); ?>"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Judul Buku
                            </label>

                            <input
                                type="text"
                                name="judul_buku"
                                class="form-control"
                                value="<?= htmlspecialchars($buku['judul_buku'], ENT_QUOTES, 'UTF-8'); ?>"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Penulis
                            </label>

                            <input
                                type="text"
                                name="penulis"
                                class="form-control"
                                value="<?= htmlspecialchars($buku['penulis'], ENT_QUOTES, 'UTF-8'); ?>"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Penerbit
                            </label>

                            <input
                                type="text"
                                name="penerbit"
                                class="form-control"
                                value="<?= htmlspecialchars($buku['penerbit'], ENT_QUOTES, 'UTF-8'); ?>"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Tahun Terbit
                            </label>

                            <input
                                type="number"
                                name="tahun_terbit"
                                class="form-control"
                                value="<?= htmlspecialchars($buku['tahun_terbit'], ENT_QUOTES, 'UTF-8'); ?>"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label" for="stok">
                                Stok
                            </label>

                            <input
                                id="stok"
                                type="number"
                                name="stok"
                                class="form-control"
                                min="0"
                                value="<?= htmlspecialchars((string) $buku['stok'], ENT_QUOTES, 'UTF-8'); ?>"
                                required>

                        </div>

                        <a
                            href="index.php?content=buku"
                            class="btn btn-secondary">

                            Kembali

                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary">

                            Simpan Buku

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>