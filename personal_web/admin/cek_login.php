<?php
include('../koneksi.php');
session_start();

$username = mysqli_real_escape_string($db, $_POST['username']);
$password = mysqli_real_escape_string($db, $_POST['password']);

// Cek apakah username dan password cocok
$sql = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'";
$query = mysqli_query($db, $sql);

if (mysqli_num_rows($query) > 0) {
    $data = mysqli_fetch_assoc($query);

    // Simpan ke session
    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = $data['role'];

    // Arahkan sesuai role
    if ($data['role'] == 'admin') {
        echo "<script>
            alert('Login admin berhasil');
            window.location.href = 'beranda_admin.php';
        </script>";
    } elseif ($data['role'] == 'user') {
        echo "<script>
            alert('Login user berhasil');
            window.location.href = '../index.php';
        </script>";
    } else {
        echo "<script>
            alert('Role tidak dikenali');
            window.location.href = 'login.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Login gagal! Username atau password salah.');
        window.location.href = 'login.php';
    </script>";
}
?>
