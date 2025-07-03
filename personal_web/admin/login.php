<?php 
session_start(); 
require_once("../koneksi.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Login Administrator</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-900 via-indigo-900 to-gray-900 overflow-hidden">

    <!-- Background Particles -->
    <canvas id="background-canvas" class="absolute top-0 left-0 w-full h-full -z-10"></canvas>

    <!-- Login Box -->
    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-8 shadow-2xl z-10 w-full max-w-md text-white">
        <h2 class="text-2xl font-bold text-center mb-6">Login Administrator</h2>
        
        <form action="cek_login.php" method="post" class="space-y-5">
            <div>
                <label for="username" class="block text-sm font-medium">Username</label>
                <input
                    type="text"
                    name="username"
                    id="username"
                    required
                    class="mt-1 block w-full rounded-md bg-white/20 text-white placeholder-white/80 border border-white/30 focus:ring-2 focus:ring-blue-500 focus:outline-none p-2"
                />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium">Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    class="mt-1 block w-full rounded-md bg-white/20 text-white placeholder-white/80 border border-white/30 focus:ring-2 focus:ring-blue-500 focus:outline-none p-2"
                />
            </div>

            <div class="flex justify-between items-center">
                <input
                    type="submit"
                    name="login"
                    value="Login"
                    class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-white cursor-pointer"
                />
                <input
                    type="reset"
                    name="cancel"
                    value="Cancel"
                    class="bg-white/30 hover:bg-white/50 px-4 py-2 rounded text-white cursor-pointer"
                />
            </div>
        </form>

        <div class="text-center text-xs text-white mt-6">
            &copy; <?php echo date('Y'); ?> - Dzikriapap
        </div>
    </div>

    <!-- Particles Animation -->
    <script>
    const canvas = document.getElementById("background-canvas");
    const ctx = canvas.getContext("2d");

    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    let particlesArray = [];

    class Particle {
      constructor() {
        this.x = Math.random() * canvas.width;
        this.y = Math.random() * canvas.height;
        this.size = Math.random() * 2 + 0.5;
        this.speedX = Math.random() * 1 - 0.5;
        this.speedY = Math.random() * 1 - 0.5;
      }

      update() {
        this.x += this.speedX;
        this.y += this.speedY;
        if (this.x < 0 || this.x > canvas.width) this.speedX *= -1;
        if (this.y < 0 || this.y > canvas.height) this.speedY *= -1;
      }

      draw() {
        ctx.fillStyle = "#00bfff";
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        ctx.fill();
      }
    }

    function initParticles() {
      particlesArray = [];
      for (let i = 0; i < 100; i++) {
        particlesArray.push(new Particle());
      }
    }

    function animateParticles() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      particlesArray.forEach(p => {
        p.update();
        p.draw();
      });
      requestAnimationFrame(animateParticles);
    }

    initParticles();
    animateParticles();
    </script>
</body>
</html>
