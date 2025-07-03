<?php 
include('../koneksi.php'); 
session_start(); 
if (!isset($_SESSION['username'])) { 
    header('location:login.php'); 
    exit; 
} 

$id = $_GET['id_gallery']; 

// Ambil nama file foto terlebih dahulu
$get = mysqli_query($db, "SELECT foto FROM tbl_gallery WHERE id_gallery = '$id'");
$data = mysqli_fetch_array($get);
$foto = $data['foto'];

// Hapus data dari database
$sql = "DELETE FROM tbl_gallery WHERE id_gallery = '$id'"; 
$query = mysqli_query($db, $sql); 

if ($query) { 
    // Hapus file dari folder jika ada
    $file_path = "../images/" . $foto;
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    echo "<script>alert('Gambar berhasil dihapus.'); window.location='data_gallery.php';</script>"; 
} else { 
    echo "<script>alert('Gagal menghapus gambar.'); history.back();</script>"; 
} 
?>
