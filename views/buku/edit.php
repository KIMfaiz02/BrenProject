<?php
$buku = $buku ?? [];
$pesan_error = $pesan_error ?? '';
?>
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Buku</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow border-0">

                <div class="card-header bg-warning">

                    <h4 class="mb-0">
                        Edit Buku
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
                                value="<?= htmlspecialchars($buku['kode_buku']); ?>"
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
                                value="<?= htmlspecialchars($buku['judul_buku']); ?>"
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
                                value="<?= htmlspecialchars($buku['penulis']); ?>"
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
                                value="<?= htmlspecialchars($buku['penerbit']); ?>"
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
                                value="<?= htmlspecialchars($buku['tahun_terbit']); ?>"
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
                                value="<?= htmlspecialchars($_POST['stok'] ?? (string) $buku['stok']); ?>"
                                required>

                        </div>

                        <a
                            href="index.php?content=buku"
                            class="btn btn-secondary">

                            Kembali

                        </a>

                        <button
                            type="submit"
                            class="btn btn-warning">

                            Update Buku

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>