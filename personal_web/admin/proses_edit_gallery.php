<?php 
include('../koneksi.php'); 
session_start(); 
if (!isset($_SESSION['username'])) { 
    header('location:login.php'); 
    exit; 
} 

$id     = $_POST['id_gallery']; 
$judul  = mysqli_real_escape_string($db, $_POST['judul']); 
$foto   = $_FILES['foto']['name']; 
$tmp    = $_FILES['foto']['tmp_name']; 

if (!empty($foto)) {
    $folder = '../images/';
    $target = $folder . basename($foto);
    if (move_uploaded_file($tmp, $target)) {
        $sql = "UPDATE tbl_gallery SET judul = '$judul', foto = '$foto' WHERE id_gallery = '$id'";
    } else {
        echo "<script>alert('Gagal mengupload gambar baru.'); history.back();</script>";
        exit;
    }
} else {
    $sql = "UPDATE tbl_gallery SET judul = '$judul' WHERE id_gallery = '$id'";
}

$query = mysqli_query($db, $sql);
if ($query) {
    echo "<script>alert('Data berhasil diperbarui.'); window.location='data_gallery.php';</script>";
} else {
    echo "<script>alert('Gagal menyimpan perubahan.'); history.back();</script>";
}
?>
