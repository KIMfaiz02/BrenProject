<?php
$anggota = $anggota ?? [];
$pesan_error = $pesan_error ?? '';
?>
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Anggota</title>

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
                        Edit Anggota
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
                                ID Anggota
                            </label>

                            <input
                                type="text"
                                name="id_anggota"
                                class="form-control"
                                value="<?= htmlspecialchars($anggota['id_anggota']); ?>"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Nama
                            </label>

                            <input
                                type="text"
                                name="nama"
                                class="form-control"
                                value="<?= htmlspecialchars($anggota['nama']); ?>"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Alamat
                            </label>

                            <textarea
                                name="alamat"
                                class="form-control"
                                rows="4"
                                required><?= htmlspecialchars($anggota['alamat']); ?></textarea>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Nomor Telepon
                            </label>

                            <input
                                type="text"
                                name="no_telepon"
                                class="form-control"
                                value="<?= htmlspecialchars($anggota['no_telepon']); ?>"
                                required>

                        </div>

                        <a
                            href="index.php?content=anggota"
                            class="btn btn-secondary">

                            Kembali

                        </a>

                        <button
                            type="submit"
                            class="btn btn-warning">

                            Update Anggota

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>