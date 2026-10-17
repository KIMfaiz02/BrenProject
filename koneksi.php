<?php

class Koneksi
{
    private string $host = "localhost";
    private string $user = "root";
    private string $pass = "";
    private string $db = "practice3_db";
        
    public mysqli $conn;

    public function __construct()
    {
        $this->conn = new mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->db
        );

        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }
}

$db = new Koneksi();

$koneksi = $db->conn;
?>