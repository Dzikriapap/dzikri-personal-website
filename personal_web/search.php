<?php
include "koneksi.php";
session_start();
$query = isset($_GET['query']) ? trim($_GET['query']) : '';
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <title>Hasil Pencarian</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Header -->
  <header class="bg-blue-900 text-white text-center p-6 text-2xl font-bold">
    Hasil Pencarian
  </header>

  <!-- Konten -->
  <main class="max-w-4xl mx-auto p-6 mt-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Menampilkan hasil untuk: <span class="text-blue-600">"<?= htmlspecialchars($query) ?>"</span></h2>

    <?php
    if ($query !== '') {
      $sql = "SELECT * FROM tbl_artikel WHERE nama_artikel LIKE '%$query%' OR isi_artikel LIKE '%$query%' ORDER BY id_artikel DESC";
      $result = mysqli_query($db, $sql);

      if (mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_assoc($result)) {
          echo "<div class='mb-6 border-b pb-4'>";
          echo "<h3 class='text-lg font-bold text-blue-700'>" . htmlspecialchars($data['nama_artikel']) . "</h3>";
          echo "<p class='text-gray-700'>" . substr(strip_tags($data['isi_artikel']), 0, 200) . "...</p>";
          echo "</div>";
        }
      } else {
        echo "<p class='text-red-600'>Tidak ada artikel yang cocok dengan pencarian.</p>";
      }
    } else {
      echo "<p class='text-gray-600'>Silakan masukkan kata kunci pencarian.</p>";
    }
    ?>
    <div class="mt-6">
      <a href="index.php" class="text-blue-600 hover:underline">&larr; Kembali ke Beranda</a>
    </div>
  </main>

</body>
</html>
