<?php
include "koneksi.php";
$sql = "SELECT * FROM tbl_gallery WHERE foto IS NOT NULL AND foto != '' AND judul IS NOT NULL AND judul != '' ORDER BY id_gallery DESC";
$query = mysqli_query($db, $sql);
session_start();
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <title>Gallery</title>
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

<body class="font-sans min-h-screen">

  <!-- Toggle Dark/Light -->
  <div class="theme-switch">
    <label>
      <input type="checkbox" id="theme-toggle">
      <span class="slider"></span>
    </label>
  </div>

  <!-- Header -->
  <header class="bg-blue-900 text-white text-center p-6 text-2xl font-bold">
    Gallery - Personal Web
  </header>

  <!-- Konten -->
  <main class="max-w-6xl mx-auto p-6 grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
    <?php while ($data = mysqli_fetch_array($query)) : ?>
      <div class="card p-4 rounded shadow text-center">
        <img src="images/<?php echo htmlspecialchars($data['foto']); ?>" alt="Gambar Gallery" class="w-full h-48 object-cover rounded mb-3">
        <h2 class="text-lg font-semibold text-blue-600"><?php echo htmlspecialchars($data['judul']); ?></h2>
      </div>
    <?php endwhile; ?>
  </main>

  <!-- Footer -->
  <footer class="bg-blue-800 text-white text-center py-4 mt-10">
    &copy; <?php echo date('Y'); ?> | Created by Dzikriapap
  </footer>

  <script>
    const toggle = document.getElementById('theme-toggle');
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
      document.documentElement.setAttribute('data-theme', 'dark');
      toggle.checked = true;
    }
    toggle.addEventListener('change', function () {
      if (this.checked) {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
      } else {
        document.documentElement.setAttribute('data-theme', 'light');
        localStorage.setItem('theme', 'light');
      }
    });
  </script>

</body>
</html>
