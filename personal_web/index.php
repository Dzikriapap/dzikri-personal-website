<?php  
include "koneksi.php";
session_start();

if (isset($_POST['submit_komentar'])) {
  $nama = mysqli_real_escape_string($db, $_POST['nama']);
  $isi = mysqli_real_escape_string($db, $_POST['isi']);
  $id_artikel = $_POST['id_artikel'];

  $query_komen = "INSERT INTO komentar (id_artikel, nama, isi) VALUES ('$id_artikel', '$nama', '$isi')";
  mysqli_query($db, $query_komen);
}

$limit = 1;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

$result_total = mysqli_query($db, "SELECT COUNT(*) as total FROM tbl_artikel");
$total_row = mysqli_fetch_assoc($result_total);
$total_artikel = $total_row['total'];

$sql = "SELECT * FROM tbl_artikel ORDER BY id_artikel DESC LIMIT $limit OFFSET $offset";
$query = mysqli_query($db, $sql);
$data = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <title>Personal Web | Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.11.1/tsparticles.bundle.min.js"></script>
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
      color: #e2e8f0 !important;
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
    #particles-bg canvas {
      position: absolute !important;
      top: 0;
      left: 0;
      z-index: -1;
      opacity: 0.4;
      pointer-events: none;
    }
    .animate-fade-in {
      animation: fadeIn 0.5s ease-in;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body class="font-sans">

  <!-- Partikel Galaxy -->
  <div id="particles-bg" class="fixed top-0 left-0 w-full h-full -z-10"></div>

  <!-- Search + Toggle -->
  <div class="flex items-center gap-2 absolute top-2 right-4 z-50">
    <form action="search.php" method="GET" class="relative w-10 h-10 hover:w-64 focus-within:w-64 transition-all duration-500 ease-in-out bg-white border-2 border-gray-300 rounded-full overflow-hidden shadow">
      <input type="search" name="query" placeholder="Search..." 
        class="absolute top-0 left-0 w-full h-full pl-4 pr-10 text-sm text-black opacity-0 focus:opacity-100 hover:opacity-100 bg-transparent outline-none transition-opacity duration-300 rounded-full">
      <button type="submit" class="absolute top-0 right-0 w-10 h-10 text-purple-600 hover:bg-purple-600 hover:text-white rounded-full">
        <i class="fa fa-search mt-2 ml-2"></i>
      </button>
    </form>
    <div class="theme-switch">
      <label class="flex items-center">
        <input type="checkbox" id="theme-toggle">
        <span class="slider"></span>
      </label>
    </div>
  </div>

  <!-- Header -->
  <header class="bg-blue-900 text-white text-center p-6 text-2xl font-bold">
    Personal Web | Dzikriapap
  </header>

  <!-- Nav -->
  <nav class="bg-blue-700 text-white py-3 relative">
    <div class="max-w-6xl mx-auto flex justify-center relative">
      <ul class="flex space-x-10 font-medium text-lg">
        <li><a href="index.php" class="hover:underline">Artikel</a></li>
        <li><a href="gallery.php" class="hover:underline">Gallery</a></li>
        <li><a href="about.php" class="hover:underline">About</a></li>
        <li><a href="admin/login.php" class="hover:underline">Login</a></li>
      </ul>
    </div>
  </nav>

  <!-- Main -->
  <main class="max-w-6xl mx-auto p-6 grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
    <section class="md:col-span-2 bg-white p-6 rounded shadow">
      <?php if ($data): ?>
        <h2 class="text-xl font-bold mb-4 text-blue-700"><?= htmlspecialchars($data['nama_artikel']) ?></h2>
        
        <?php
        $image_map = [
          1 => "images/waspada_game_ntf.webp",
          2 => "images/pendaki_brazil.jpg",
          3 => "images/isu_perang_dunia_ketiga.jpg",
          4 => "images/krisis_penambangan_raja_ampat.jpg",
          5 => "images/mutilasi_perempuan_somalia.avif",
          6 => "images/sosial-era.jpg"
        ];
        if (isset($image_map[$page])) {
          echo "<img src='" . $image_map[$page] . "' alt='Gambar artikel' class='w-full rounded mb-4'>";
        }
        ?>

        <p class="text-gray-700 leading-relaxed"><?= nl2br(htmlspecialchars($data['isi_artikel'])) ?></p>

        <!-- Form Komentar -->
        <div class="mt-10 p-4 border rounded bg-white shadow-md">
          <h2 class="text-xl font-semibold mb-4">Tinggalkan Komentar</h2>
          <form action="" method="POST">
            <input type="hidden" name="id_artikel" value="<?= $data['id_artikel'] ?>">
            <input type="text" name="nama" placeholder="Nama" required class="w-full p-2 border rounded mb-3" />
            <textarea name="isi" placeholder="Tulis komentarmu..." required class="w-full p-2 border rounded mb-3"></textarea>
            <button type="submit" name="submit_komentar" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
              Kirim Komentar
            </button>
          </form>
        </div>

        <!-- Komentar -->
        <div class="mt-6 p-4 border rounded bg-gray-50">
          <h2 class="text-lg font-semibold mb-3">Komentar</h2>
          <div id="komentar-container">
            <?php
              $id_artikel = $data['id_artikel'];
              $limit_komentar = 3;
              $result = mysqli_query($db, "SELECT * FROM komentar WHERE id_artikel = $id_artikel ORDER BY tanggal DESC LIMIT $limit_komentar");
              $jumlah_loaded = mysqli_num_rows($result);
              while ($komen = mysqli_fetch_assoc($result)) {
                echo '<div class="mb-4 border-b pb-2 animate-fade-in">';
                echo '<p class="font-semibold text-sm text-blue-700">' . htmlspecialchars($komen['nama']) . '</p>';
                echo '<p class="text-sm text-gray-800">' . nl2br(htmlspecialchars($komen['isi'])) . '</p>';
                echo '<p class="text-xs text-gray-500">' . $komen['tanggal'] . '</p>';
                echo '</div>';
              }
              $total_komen = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) as total FROM komentar WHERE id_artikel = $id_artikel"))['total'];
            ?>
          </div>
          <?php if ($jumlah_loaded < $total_komen): ?>
            <div class="text-center mt-4">
              <button id="load-more" data-offset="<?= $jumlah_loaded ?>" data-id="<?= $id_artikel ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Load More Komentar
              </button>
            </div>
          <?php endif; ?>
        </div>

        <!-- Navigasi Artikel -->
        <div class="mt-8 flex justify-between text-blue-600 font-semibold text-sm">
          <?php if ($page > 1): ?>
            <a href="index.php?page=<?= $page - 1 ?>" class="hover:underline">← Sebelumnya</a>
          <?php endif; ?>
          <?php if ($page < $total_artikel): ?>
            <a href="index.php?page=<?= $page + 1 ?>" class="hover:underline">Selanjutnya →</a>
          <?php endif; ?>
        </div>
      <?php else: ?>
        <p class="text-red-600">Artikel tidak ditemukan.</p>
      <?php endif; ?>
    </section>

    <aside class="bg-white p-6 rounded shadow">
      <h2 class="text-lg font-bold mb-4">Daftar Artikel</h2>
      <ul class="space-y-2 list-disc list-inside text-gray-700">
        <?php
        $list_query = mysqli_query($db, "SELECT * FROM tbl_artikel ORDER BY id_artikel DESC");
        while ($list = mysqli_fetch_array($list_query)) {
          echo "<li>" . htmlspecialchars($list['nama_artikel']) . "</li>";
        }
        ?>
      </ul>
    </aside>
  </main>

  <!-- Footer -->
  <footer class="bg-blue-800 text-white text-center py-4 mt-10">
    &copy; <?= date('Y'); ?> | Created by Dzikriapap
  </footer>

  <!-- Dark Mode Script -->
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

  <!-- Load More Komentar -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const btn = document.getElementById('load-more');
      if (btn) {
        btn.addEventListener('click', function () {
          const offset = parseInt(this.getAttribute('data-offset'));
          const id = this.getAttribute('data-id');
          const btnEl = this;

          fetch(`load_komentar.php?id_artikel=${id}&offset=${offset}`)
            .then(res => res.text())
            .then(data => {
              const container = document.getElementById('komentar-container');
              container.insertAdjacentHTML('beforeend', data);
              btnEl.setAttribute('data-offset', offset + 3);

              if (offset + 3 >= <?= $total_komen ?>) {
                btnEl.style.display = 'none';
              }
            });
        });
      }
    });
  </script>

  <!-- tsParticles Script -->
  <script>
    tsParticles.load("particles-bg", {
      fullScreen: { enable: false },
      background: { color: { value: "transparent" } },
      particles: {
        number: { value: 30, density: { enable: true, area: 800 } },
        color: { value: "#FFD700" },
        shape: { type: "circle" },
        size: { value: { min: 1, max: 2 } },
        opacity: { value: 0.6 },
        move: {
          enable: true,
          speed: 0.3,
          direction: "none",
          outModes: { default: "out" }
        }
      },
      emitters: {
        direction: "bottom-right",
        rate: { delay: 8, quantity: 1 },
        particles: {
          color: { value: "#FFD700" },
          shape: { type: "circle" },
          size: { value: 3 },
          move: {
            speed: 1.5,
            straight: true,
            outModes: { default: "out" }
          },
          opacity: { value: 0.8 },
          trail: {
            enable: true,
            length: 6,
            fillColor: "transparent"
          }
        }
      }
    });
  </script>

  <!-- Scroll otomatis ke atas jika komentar dikirim -->
  <script>
    <?php if (isset($_POST['submit_komentar'])): ?>
      window.onload = () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
      };
    <?php endif; ?>
  </script>

</body>
</html>
