<?php 
include('../koneksi.php'); 
session_start(); 

$judul = mysqli_real_escape_string($db, trim($_POST['judul'])); 
$foto  = $_FILES['foto']['name']; 
$tmp   = $_FILES['foto']['tmp_name']; 

// Validasi input
if (empty($judul) || empty($foto)) {
    echo "<script>alert('Judul dan gambar wajib diisi!'); history.back();</script>";
    exit;
}

$folder = '../images/'; 
$target = $folder . basename($foto); 

// Pindahkan gambar ke folder
if (move_uploaded_file($tmp, $target)) { 
    $sql = "INSERT INTO tbl_gallery (judul, foto) VALUES ('$judul', '$foto')"; 
    $query = mysqli_query($db, $sql); 

    // Cek apakah query berhasil
    if (!$query) {
        die("Query error: " . mysqli_error($db));
    }

    // Jika berhasil
    echo "<script>alert('Gambar berhasil ditambahkan.'); window.location='data_gallery.php';</script>"; 

} else { 
    echo "<script>alert('Gagal mengupload gambar. Pastikan format file benar.'); history.back();</script>"; 
} 
?>
