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
    <title>Kelola Artikel</title> 
    <script src="https://cdn.tailwindcss.com"></script> 
    <style>
        [data-theme="dark"] {
            --bg-color: #1a202c;
            --text-color: #f7fafc;
            --card-bg: #2d3748;
            --border-color: #4a5568;
        }

        [data-theme="light"] {
            --bg-color: #f7fafc;
            --text-color: #1a202c;
            --card-bg: #ffffff;
            --border-color: #e2e8f0;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
        }

        .card {
            background-color: var(--card-bg);
        }

        .border-custom {
            border-color: var(--border-color);
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
        [data-theme="dark"] table,
        [data-theme="dark"] th,
        [data-theme="dark"] td {
            background-color: #2d3748;
            color: #f7fafc;
        }

        [data-theme="light"] table,
        [data-theme="light"] th,
        [data-theme="light"] td {
            background-color: #ffffff;
            color: #1a202c;
        }

    </style>
</head> 
<body class="min-h-screen">

<!-- Toggle Theme -->
<div class="theme-switch">
  <label>
    <input type="checkbox" id="theme-toggle">
    <span class="slider"></span>
  </label>
</div>

<!-- Header -->
<header class="bg-blue-900 text-white text-center py-6 shadow"> 
    <h1 class="text-3xl font-bold">// HALAMAN ADMIN //</h1> 
</header> 

<div class="flex max-w-7xl mx-auto mt-8 px-4"> 

    <!-- Sidebar -->
    <aside class="w-1/4 card rounded shadow p-4"> 
        <h2 class="text-xl font-semibold text-blue-500 mb-4 text-center">MENU</h2> 
        <ul class="space-y-2 font-medium"> 
            <li><a href="beranda_admin.php" class="block hover:text-blue-400">Beranda</a></li> 
            <li><a href="data_artikel.php" class="block font-semibold text-blue-800">Kelola Artikel</a></li> 
            <li><a href="data_gallery.php" class="block hover:text-blue-400">Kelola Gallery</a></li> 
            <li><a href="about.php" class="block hover:text-blue-400">About</a></li> 
            <li>
                <a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?');" 
                   class="block text-red-500 hover:underline font-medium">Logout</a> 
            </li> 
        </ul> 
    </aside> 

    <!-- Main Content -->
    <main class="w-3/4 card rounded shadow p-6 ml-6"> 
        <div class="flex justify-between items-center mb-4"> 
            <h2 class="text-xl font-bold">Daftar Artikel</h2> 
            <a href="add_artikel.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Tambah Artikel
            </a> 
        </div> 

        <table class="min-w-full table-auto border border-custom text-sm"> 
            <thead class="bg-blue-600 text-white"> 
                <tr> 
                    <th class="p-3 border border-custom">No</th> 
                    <th class="p-3 border border-custom">Nama Artikel</th> 
                    <th class="p-3 border border-custom">Isi Artikel</th> 
                    <th class="p-3 border border-custom">Aksi</th> 
                </tr> 
            </thead> 
            <tbody> 
                <?php 
                $sql = "SELECT * FROM tbl_artikel"; 
                $query = mysqli_query($db, $sql); 
                $no = 1; 
                while ($data = mysqli_fetch_array($query)) { 
                    echo "<tr class='even:bg-gray-50 dark:even:bg-gray-700'>";
                    echo "<td class='border border-custom p-2 text-center'>" . $no++ . "</td>"; 
                    echo "<td class='border border-custom p-2'>" . htmlspecialchars($data['nama_artikel']) . "</td>"; 
                    echo "<td class='border border-custom p-2'>" . htmlspecialchars($data['isi_artikel']) . "</td>"; 
                    echo "<td class='border border-custom p-2 text-center space-x-2'> 
                            <a href='edit_artikel.php?id_artikel={$data['id_artikel']}' 
                               class='text-blue-600 hover:underline'>Edit</a> 
                            <a href='delete_artikel.php?id_artikel={$data['id_artikel']}' 
                               onclick='return confirm(\"Yakin ingin menghapus?\")' 
                               class='text-red-600 hover:underline'>Hapus</a> 
                          </td>"; 
                    echo "</tr>"; 
                } 
                ?> 
            </tbody> 
        </table> 
    </main> 
</div> 

<!-- Footer -->
<footer class="bg-blue-800 text-white text-center py-4 mt-10"> 
    &copy; <?php echo date('Y'); ?> | Created by Dzikriapap 
</footer> 

<!-- Dark Mode JS -->
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

</body> 
</html>
