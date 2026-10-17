<?php

$koneksi = new mysqli(
    'localhost',
    'root',
    '',
    'practice3_db'
);

if ($koneksi->connect_error) {
    die('Koneksi database gagal: ' . $koneksi->connect_error);
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    die('ID anggota tidak valid.');
}

$query = $koneksi->prepare(
    "DELETE FROM anggota WHERE id = ?"
);

if ($query === false) {
    die('Query gagal: ' . $koneksi->error);
}

$query->bind_param('i', $id);

if ($query->execute()) {

    $query->close();

    header(
        'Location: index.php?content=anggota'
    );

    exit;
}

$pesan_error = $query->error;

$query->close();

die(
    'Gagal menghapus anggota: ' .
    htmlspecialchars($pesan_error)
);