<?php
$title = 'Beranda';
?>

<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Beranda - Perpustakaan</title>
	<link rel="stylesheet" href="style.css">
</head>
<body class="home-page">
	<header class="site-header">
		<a class="brand" href="index.php">
			<span class="brand-mark">P</span>
			<span>Perpustakaan</span>
		</a>
		<nav class="main-nav" aria-label="Navigasi utama">
			<a class="active" href="index.php">Beranda</a>
			<a href="index.php?content=buku">Buku</a>
			<a href="index.php?content=anggota">Anggota</a>
			<a href="index.php?content=peminjaman">Peminjaman</a>
		</nav>
	</header>

	<main class="home-content">
		<section class="welcome-panel">
			<div class="welcome-copy">
				<p class="eyebrow">RUANG BACA DIGITAL</p>
				<h1>Semua koleksi,<br><em>lebih mudah ditemukan.</em></h1>
				<p class="welcome-text">Kelola koleksi buku dan data anggota perpustakaan dari satu tempat yang sederhana.</p>
				<div class="welcome-actions">
					<a class="primary-action" href="index.php?content=buku">Jelajahi koleksi <span aria-hidden="true">&#8594;</span></a>
					<a class="text-action" href="index.php?content=anggota">Lihat anggota</a>
				</div>
			</div>
			<div class="welcome-art" aria-hidden="true">
				<div class="sun"></div>
				<div class="book-stack stack-back"></div>
				<div class="book-stack stack-middle"></div>
				<div class="book-stack stack-front"></div>
				<span class="art-label">baca<br>dan<br>temukan</span>
			</div>
		</section>

		<section class="quick-section" aria-labelledby="quick-title">
			<div class="section-heading">
				<div>
					<p class="eyebrow">AKSES CEPAT</p>
					<h2 id="quick-title">Apa yang ingin kamu kelola?</h2>
				</div>
				<span class="section-note">Pilih menu untuk mulai</span>
			</div>

			<div class="quick-grid">
				<a class="quick-card books-card" href="index.php?content=buku">
					<span class="card-icon" aria-hidden="true">&#128218;</span>
					<span class="card-content">
						<strong>Data Buku</strong>
						<span>Kelola judul, penulis, dan penerbit.</span>
					</span>
					<span class="card-arrow" aria-hidden="true">&#8599;</span>
				</a>
				<a class="quick-card members-card" href="index.php?content=anggota">
					<span class="card-icon" aria-hidden="true">&#128100;</span>
					<span class="card-content">
						<strong>Data Anggota</strong>
						<span>Atur informasi anggota perpustakaan.</span>
					</span>
					<span class="card-arrow" aria-hidden="true">&#8599;</span>
				</a>
				<a class="quick-card loans-card" href="index.php?content=peminjaman">
					<span class="card-icon" aria-hidden="true">&#128214;</span>
					<span class="card-content">
						<strong>Peminjaman</strong>
						<span>Catat peminjaman dan pengembalian buku.</span>
					</span>
					<span class="card-arrow" aria-hidden="true">&#8599;</span>
				</a>
			</div>
		</section>
	</main>

	<footer class="home-footer">
		<span>Perpustakaan</span>
		<span>Kelola dengan rapi, temukan dengan mudah.</span>
	</footer>
</body>
</html>