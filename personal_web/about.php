<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8" />
    <title>About | Personal Web</title>
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

        /* Toggle switch style */
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
        About Me | Dzikriapap
    </header>

    <!-- Navigation -->
    <nav class="bg-blue-700 text-white py-3">
        <ul class="flex justify-center space-x-10 font-medium text-lg">
            <li><a href="index.php" class="hover:underline">Artikel</a></li>
            <li><a href="gallery.php" class="hover:underline">Gallery</a></li>
            <li><a href="about.php" class="hover:underline">About</a></li>
            <li><a href="admin/login.php" class="hover:underline">Login</a></li>
        </ul>
    </nav>

    <!-- About Content -->
    <main class="max-w-3xl mx-auto p-6 card rounded shadow mt-8">
        <h2 class="text-xl font-bold mb-4 text-blue-700">Tentang Saya</h2>
        <?php
        $query = mysqli_query($db, "SELECT * FROM tbl_about ORDER BY id_about DESC LIMIT 1");
        if (!$query) {
            die("Query gagal: " . mysqli_error($db));
        }

        if ($row = mysqli_fetch_assoc($query)) {
            echo "<p class='text-justify text-base leading-relaxed'>" . nl2br($row['about']) . "</p>";
        } else {
            echo "<p class='text-gray-500 italic'>Data belum tersedia.</p>";
        }
        ?>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white text-center p-4 mt-12">
        &copy; 2025 | Created by Dzikriapap
    </footer>

    <!-- JavaScript for theme toggle -->
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
