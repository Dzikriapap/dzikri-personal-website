<?php 
include('../koneksi.php'); 
session_start(); 
if (!isset($_SESSION['username'])) { 
    header('location:login.php'); 
    exit; 
} 
?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Gambar</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
  <header class="bg-blue-900 text-white text-center py-6 shadow">
    <h1 class="text-3xl font-bold">Tambah Gambar ke Gallery</h1>
  </header>

  <div class="flex max-w-7xl mx-auto mt-8 px-4">
    <!-- Sidebar -->
    <aside class="w-1/4 bg-white rounded shadow p-4">
      <!-- Sidebar menu -->
    </aside>

    <!-- Main Content -->
    <main class="w-3/4 bg-white rounded shadow p-6 ml-6">
      <form action="proses_add_gallery.php" method="post" enctype="multipart/form-data" class="space-y-6">
        <div>
          <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Gambar</label>
          <input type="text" id="judul" name="judul" required class="w-full p-2 border rounded focus:outline-none focus:ring focus:border-blue-500">
        </div>
        <div>
          <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Pilih Gambar</label>
          <input type="file" id="foto" name="foto" accept="image/*" required class="block w-full text-sm text-gray-600 file:bg-blue-100 hover:file:bg-blue-200 file:text-blue-700">
        </div>
        <div class="flex justify-end space-x-4">
          <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800 transition">Simpan</button>
          <a href="data_gallery.php" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition">Batal</a>
        </div>
      </form>
    </main>
  </div>
</body>
</html>
