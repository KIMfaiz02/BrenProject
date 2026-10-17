ALTER TABLE buku
    ADD COLUMN stok INT UNSIGNED NOT NULL DEFAULT 1;

CREATE TABLE peminjaman (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    id_buku INT NOT NULL,
    id_anggota INT NOT NULL,
    tanggal_pinjam DATE NOT NULL,
    tanggal_kembali DATE DEFAULT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'Dipinjam',
    PRIMARY KEY (id),
    KEY idx_peminjaman_buku (id_buku),
    KEY idx_peminjaman_anggota (id_anggota),
    CONSTRAINT fk_peminjaman_buku
        FOREIGN KEY (id_buku) REFERENCES buku (id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_peminjaman_anggota
        FOREIGN KEY (id_anggota) REFERENCES anggota (id)
        ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;