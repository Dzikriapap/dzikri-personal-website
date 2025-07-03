<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
  echo "<script>
    alert('Akses ditolak! Anda bukan admin.');
    window.location.href = '../index.php';
  </script>";
  exit;
}
include('../koneksi.php');
$username = $_SESSION['username'];
$sql = "SELECT * FROM tbl_user WHERE username = '$username'";
$query = mysqli_query($db, $sql);
$hasil = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
  [data-theme="dark"] {
    background-color: #1e293b;
    color: #f1f5f9;
  }

  [data-theme="dark"] .bg-white {
    background-color: #334155 !important;
  }

  [data-theme="dark"] .text-gray-700,
  [data-theme="dark"] .text-gray-800 {
    color: #f1f5f9 !important;
  }

  [data-theme="dark"] a {
    color: #cbd5e1;
  }

  [data-theme="dark"] .text-blue-700 {
    color: #93c5fd !important;
  }

  [data-theme="dark"] .text-green-700 {
    color: #6ee7b7 !important;
  }

  [data-theme="dark"] .border-blue-600 {
    border-color: #3b82f6 !important;
  }

  [data-theme="dark"] .border-green-600 {
    border-color: #10b981 !important;
  }

  .theme-switch {
    position: absolute;
    top: 16px;
    right: 16px;
  }

  .theme-switch input {
    display: none;
  }

  .slider {
    width: 50px;
    height: 26px;
    background-color: #ccc;
    border-radius: 34px;
    position: relative;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .slider:before {
    content: "";
    position: absolute;
    height: 20px;
    width: 20px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    border-radius: 50%;
    transition: transform 0.3s;
  }

  input:checked + .slider {
    background-color: #0fbcf9;
  }

  input:checked + .slider:before {
    transform: translateX(24px);
  }
</style>
</head>
<body class="min-h-screen font-sans">

  <!-- Toggle -->
  <div class="theme-switch">
    <label>
      <input type="checkbox" id="theme-toggle">
      <span class="slider"></span>
    </label>
  </div>

  <!-- Header -->
  <header class="bg-blue-900 text-white text-center py-6 shadow">
    <h1 class="text-3xl font-bold">Halaman Administrator</h1>
  </header>

  <!-- Container -->
  <div class="flex max-w-7xl mx-auto mt-8 px-4">
    <!-- Sidebar -->
    <aside class="w-1/4 bg-white rounded shadow p-4">
      <h2 class="text-xl font-semibold text-blue-700 mb-4 text-center">MENU</h2>
      <ul class="space-y-2 text-gray-700">
        <li><a href="beranda_admin.php" class="block hover:text-blue-600">Beranda</a></li>
        <li><a href="data_artikel.php" class="block hover:text-blue-600">Kelola Artikel</a></li>
        <li><a href="data_gallery.php" class="block hover:text-blue-600">Kelola Gallery</a></li>
        <li><a href="about.php" class="block hover:text-blue-600">About</a></li>
        <li><a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?');" class="block text-red-600 hover:underline font-medium">Logout</a></li>
      </ul>
    </aside>

    <?php
    $jumlah_artikel = mysqli_num_rows(mysqli_query($db, "SELECT id_artikel FROM tbl_artikel"));
    $jumlah_gallery = mysqli_num_rows(mysqli_query($db, "SELECT id_gallery FROM tbl_gallery"));
    ?>

    <!-- Main Content -->
    <main class="w-3/4 bg-white rounded shadow p-6 ml-6">
      <div class="text-lg text-gray-800 mb-4">
        Halo, <strong class="text-blue-700"><?php echo $_SESSION['username']; ?></strong>! Apa kabar? 😊
      </div>
      <p class="text-sm text-gray-500">Silakan gunakan menu di samping untuk mengelola data.</p>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
        <div class="bg-white shadow rounded p-4 text-center border-t-4 border-blue-600">
          <h3 class="text-xl font-semibold text-blue-700">Artikel</h3>
          <p class="text-3xl font-bold text-gray-800"><?php echo $jumlah_artikel; ?></p>
        </div>
        <div class="bg-white shadow rounded p-4 text-center border-t-4 border-green-600">
          <h3 class="text-xl font-semibold text-green-700">Gallery</h3>
          <p class="text-3xl font-bold text-gray-800"><?php echo $jumlah_gallery; ?></p>
        </div>
      </div>
    </main>
  </div>

  <!-- Footer -->
  <footer class="bg-blue-800 text-white text-center py-4 mt-10">
    &copy; <?php echo date('Y'); ?> | Created by Dzikriapap
  </footer>

  <script>
    const toggle = document.getElementById('theme-toggle');
    const root = document.documentElement;

    toggle.addEventListener('change', function () {
      const mode = toggle.checked ? 'dark' : 'light';
      root.setAttribute('data-theme', mode);
      localStorage.setItem('theme', mode);
    });

    window.onload = () => {
      const saved = localStorage.getItem('theme') || 'light';
      toggle.checked = saved === 'dark';
      root.setAttribute('data-theme', saved);
    };
  </script>
</body>
</html>
