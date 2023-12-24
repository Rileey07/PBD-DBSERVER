<?php
session_start();
require("../sistem/koneksi.php");

$hub = open_connection();
$usr = mysqli_real_escape_string($hub, $_POST['usr']); // Sanitize input
$psw = mysqli_real_escape_string($hub, $_POST['psw']); // Sanitize input
$op = isset($_GET['op']) ? $_GET['op'] : '';

if ($op == "in") {
    $cek = mysqli_query($hub, "SELECT * FROM users WHERE username = '$usr' AND password = '$psw'") or die("Query error: " . mysqli_error($hub));

    if (mysqli_num_rows($cek) == 1) {
        $c = mysqli_fetch_assoc($cek);

        // Check if the user is already logged in
        if (isset($_SESSION['username'])) {
            die("User '" . $_SESSION['username'] . "' is already logged in. <a href=\"javascript:history.back()\">Back</a>");
        }

        // Set session variables
        $_SESSION['username'] = $c['username'];
        $_SESSION['jenisuser'] = $c['jenisuser'];

        // Set user's online status in the database
        mysqli_query($hub, "UPDATE users SET status = 'F' WHERE username = '$usr'");

        header("Location: index.php");
    } else {
        die("Username/password salah <a href=\"javascript:history.back()\">Kembali</a>");
    }
} elseif ($op == "out") {
    // Check if the user is logged in
    if (isset($_SESSION['username'])) {
        // Set user's online status to offline in the database
        $username = $_SESSION['username'];
        mysqli_query($hub, "UPDATE users SET status = 'F' WHERE username = '$username'");

        // Unset session variables
        unset($_SESSION['username']);
        unset($_SESSION['jenisuser']);

        header("Location: index.php");
    } else {
        die("No user is currently logged in <a href=\"javascript:history.back()\">Back</a>");
    }
}

mysqli_close($hub);
?>
