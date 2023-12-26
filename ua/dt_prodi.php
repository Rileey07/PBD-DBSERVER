<?php
session_start();

//koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "akademik";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("koneksi database gagal: " . $conn->connect_error);
}

// Fungsi untuk mengecek apakah pengguna memiliki hak akses untuk CRUD pada PRODI
function hasPermission()
{
    return isset($_SESSION['jenisuser']) && $_SESSION['jenisuser'] === '01' && isset($_SESSION['level']);
}

// fungsi untuk menambahkan program studi
function createProdi($kdprodi, $nmprodi, $akreditasi)
{
    global $conn;

    if (!hasPermission()) {
        return false;
    }

    // lakukan operasi INSERT ke table PRODI sesuai dengan kebutuhan anda
    $sql = "INSERT INTO PRODI (kdprodi, nmprodi, akreditasi) VALUES ('$kdprodi', '$nmprodi', '$akreditasi')";

    return $conn->query($sql) or die($conn->error);
}

// fungsi untuk mendapatkan informasi program studi
function readProdi($idprodi)
{
    global $conn;

    if (!hasPermission()) {
        return null;
    }

    // lakukan operasi SELECT ke table PRODI sesuai dengan kebutuhan anda
    $sql = "SELECT * FROM PRODI WHERE idprodi = $idprodi";

    $result = $conn->query($sql) or die($conn->error);
    return $result->fetch_assoc();
}

// fungsi untuk memperbarui informasi program studi
function updateProdi($idprodi, $kdprodi, $nmprodi, $akreditasi)
{
    global $conn;

    if (!hasPermission()) {
        return false;
    }

    // lakukan operasi UPDATE ketable prodi sesuai dengan kebutuhan anda
    $sql = "UPDATE PRODI SET kdprodi='$kdprodi', nmprodi='$nmprodi', akreditasi='$akreditasi' WHERE idprodi = $idprodi";

    return $conn->query($sql) or die($conn->error);
}

// fungsi untuk menghapus program studi
function deleteProdi($idprodi)
{
    global $conn;

    if (!hasPermission()) {
        return false;
    }

    // lakukan operasi DELETE ke table PRODI sesuai dengan kebutuhan anda
    $sql = "DELETE FROM PRODI WHERE idprodi=$idprodi";

    return $conn->query($sql) or die($conn->error);
}
?>
