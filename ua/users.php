<?php
session_start();

// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "akademik";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Fungsi untuk mengecek apakah pengguna memiliki hak akses untuk CRUD
function hasPermission()
{
    return isset($_SESSION['jenisuser']);
}

// Fungsi untuk menambahkan user
function createUser($nama, $username, $password, $role)
{
    global $conn;

    if (!hasPermission()) {
        return false;
    }

    // Lakukan operasi INSERT ke tabel USER sesuai dengan kebutuhan anda
    $hashedPassword = password_hash(mysqli_real_escape_string($conn, $password), PASSWORD_DEFAULT);
    $sql = "INSERT INTO USER (nama, username, password, role) VALUES ('$nama', '$username', '$hashedPassword', '$role')";

    return $conn->query($sql) or die($conn->error);
}

// Fungsi untuk mendapatkan user
function readUser($userId)
{
    global $conn;

    if (!hasPermission()) {
        return null;
    }

    // Lakukan operasi SELECT ke tabel USER sesuai dengan kebutuhan anda
    $sql = "SELECT * FROM USER WHERE id = $userId";

    $result = $conn->query($sql) or die($conn->error);
    return $result->fetch_assoc();
}

// Fungsi untuk memperbarui informasi user
function updateUser($userId, $nama, $username, $password, $role)
{
    global $conn;

    if (!hasPermission()) {
        return false;
    }

    // Lakukan operasi UPDATE ke tabel USER sesuai dengan kebutuhan anda
    $hashedPassword = password_hash(mysqli_real_escape_string($conn, $password), PASSWORD_DEFAULT);
    $sql = "UPDATE USER SET nama='$nama', username='$username', password='$hashedPassword', role='$role' WHERE id=$userId";

    return $conn->query($sql) or die($conn->error);
}

// Fungsi untuk menghapus user
function deleteUser($userId)
{
    global $conn;

    if (!hasPermission()) {
        return false;
    }

    // Lakukan operasi DELETE ke tabel USER sesuai dengan kebutuhan anda
    $sql = "DELETE FROM USER WHERE id=$userId";

    return $conn->query($sql) or die($conn->error);
}
?>
