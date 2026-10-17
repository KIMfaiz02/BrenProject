<?php

require_once __DIR__ . '/controllers/BukuController.php';
require_once __DIR__ . '/controllers/AnggotaController.php';
require_once __DIR__ . '/controllers/PeminjamanController.php';
require_once __DIR__ . '/controllers/BerandaController.php';

$content = $_GET['content'] ?? '';
$action = $_GET['action'] ?? '';
$legacyRoutes = [
    'tambah_buku' => ['buku', 'tambah'],
    'edit_buku' => ['buku', 'edit'],
    'hapus_buku' => ['buku', 'hapus'],
    'tambah_anggota' => ['anggota', 'tambah'],
    'edit_anggota' => ['anggota', 'edit'],
    'hapus_anggota' => ['anggota', 'hapus'],
];

if (isset($legacyRoutes[$content])) {
    [$content, $action] = $legacyRoutes[$content];
}

switch ($content) {
    case 'buku':
        $controller = new BukuController();
        break;
    case 'anggota':
        $controller = new AnggotaController();
        break;
    case 'peminjaman':
        $controller = new PeminjamanController();
        break;
    default:
        $controller = new BerandaController();
}

if (!in_array($action, ['tambah', 'edit', 'hapus'], true)
    || !method_exists($controller, $action)) {
    $action = 'index';
}

if ($action === 'index') {
    $controller->index();
} else {
    $controller->{$action}($_GET['id'] ?? null);
}