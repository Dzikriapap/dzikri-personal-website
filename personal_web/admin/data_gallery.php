<?php 
include('../koneksi.php'); 
session_start(); 
if (!isset($_SESSION['username'])) { 
    header('location:login.php'); 
    exit; 
} 
?> 

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <title>Kelola Gallery</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    [data-theme="dark"] {
      --bg-color: #1a202c;
      --text-color: #f7fafc;
      --card-bg: #2d3748;
    }

    [data-theme="light"] {
      --bg-color: #f7fafc;
      --text-color: #1a202c;
      --card-bg: #ffffff;
    }

    body {
      background-color: var(--bg-color);
      color: var(--text-color);
    }

    .card {
      background-color: var(--card-bg);
    }

    /* Toggle button */
    .theme-switch {
      position: absolute;
      top: 1rem;
      right: 1rem;
      display: flex;
      align-items: center;
    }

    .theme-switch input {
      display: none;
    }

    .slider {
      width: 50px;
      height: 24px;
      background: #ccc;
      border-radius: 9999px;
      position: relative;
      cursor: pointer;
    }

    .slider:before {
      content: "";
      position: absolute;
      width: 20px;
      height: 20px;
      background: #fff;
      border-radius: 50%;
      top: 2px;
      left: 2px;
      transition: 0.3s;
    }

    input:checked + .slider {
      background: #0fbf9f;
    }

    input:checked + .slider:before {
      transform: translateX(26px);
    }
  </style>
</head>
<body class="min-h-screen">
  <!-- Toggle Dark/Light -->
  <div class="theme-switch">
    <label>
      <input type="checkbox" id="theme-toggle">
      <span class="slider"></span>
    </label>
  </div>

  <header class="bg-blue-900 text-white text-center py-6 shadow">
    <h1 class="text-3xl font-bold">Kelola Gallery</h1>
  </header>

  <div class="flex max-w-7xl mx-auto mt-8 px-4">
    <!-- Sidebar -->
    <aside class="w-1/4 card rounded shadow p-4">
      <ul class="space-y-3 font-medium">
        <li><a href="beranda_admin.php" class="hover:underline">Beranda</a></li>
        <li><a href="data_artikel.php" class="hover:underline">Kelola Artikel</a></li>
        <li><a href="data_gallery.php" class="hover:underline text-blue-700">Kelola Gallery</a></li>
        <li><a href="about.php" class="hover:underline">About</a></li>
        <li><a href="logout.php" class="text-red-600 hover:underline" onclick="return confirm('Yakin ingin logout?')">Logout</a></li>
      </ul>
    </aside>

    <!-- Main Content -->
    <main class="w-3/4 card rounded shadow p-6 ml-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Daftar Gallery</h2>
        <a href="add_gallery.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">+ Tambah Gambar</a>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <?php 
        $sql = "SELECT * FROM tbl_gallery"; 
        $query = mysqli_query($db, $sql); 
        while ($data = mysqli_fetch_array($query)) {
          echo "<div class='card border rounded shadow overflow-hidden'>";
          echo "<img src='../images/{$data['foto']}' class='w-full h-48 object-cover'>";
          echo "<div class='p-4'>";
          echo "<p class='font-semibold mb-2'>" . htmlspecialchars($data['judul']) . "</p>";
          echo "<div class='flex justify-between text-sm'>";
          echo "<a href='edit_gallery.php?id_gallery={$data['id_gallery']}' class='text-blue-600 hover:underline'>Edit</a>";
          echo "<a href='delete_gallery.php?id_gallery={$data['id_gallery']}' onclick='return confirm(\"Yakin ingin menghapus?\")' class='text-red-600 hover:underline'>Hapus</a>";
          echo "</div></div></div>";
        }
        ?>
      </div>
    </main>
  </div>

  <script>
  const toggle = document.getElementById('theme-toggle');
  const saved = localStorage.getItem('theme');

  if (saved === 'dark') {
    document.documentElement.setAttribute('data-theme', 'dark');
    toggle.checked = true;
  }

  toggle.addEventListener('change', () => {
    if (toggle.checked) {
      document.documentElement.setAttribute('data-theme', 'dark');
      localStorage.setItem('theme', 'dark');
    } else {
      document.documentElement.setAttribute('data-theme', 'light');
      localStorage.setItem('theme', 'light');
    }
  });
</script>
