<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "vuln_db");
if (!$conn) {
    die("Koneksi database gagal");
}
