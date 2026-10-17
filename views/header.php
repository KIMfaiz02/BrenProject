<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? htmlspecialchars($title, ENT_QUOTES, 'UTF-8') : 'Perpustakaan'; ?> - Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav>
        <a href="index.php">Beranda</a>
        <a href="index.php?content=buku">Buku</a>
        <a href="index.php?content=anggota">Anggota</a>
        <a href="index.php?content=peminjaman">Peminjaman</a>
    </nav>

    <hr>

    <div class="content">
        <!-- Konten halaman akan dimuat di sini -->