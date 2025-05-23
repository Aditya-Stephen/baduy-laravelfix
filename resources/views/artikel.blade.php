<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <!-- Site Metas -->
  <title>Artikel Page Baduy</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- font tambahan -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Site Icons -->
  <link rel="shortcut icon" href="{{ asset('images/logobadui1.webp') }}" type="image/png" />
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-900">
  <header class="header header_style_01 bg-gray-800 py-2">
    <nav class="container mx-auto px-4">
      <div class="flex items-center justify-between">
        <!-- Logo (kiri) -->
        <div class="flex-shrink-0">
          <a href="{{ url('/') }}" class="flex items-center">
            <img src="{{ asset('images/logobadui1.webp') }}" class="h-12 w-auto object-contain" alt="Baduy Logo">
          </a>
        </div>

        <!-- Search Bar (tengah) - Hanya pada layar medium ke atas -->
        <div class="hidden md:flex flex-1 mx-8">
          <form action="{{ url('/artikel') }}" method="GET" class="w-full max-w-xl" role="search">
            <div class="relative flex items-center w-full">
              <input id="search" type="search" name="search" placeholder="Cari artikel..."
                class="w-full py-2 pl-4 pr-10 text-sm bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-blue-500"
                required />
              <button type="submit" class="absolute right-0 top-0 mt-2 mr-3 text-gray-400 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
              </button>
            </div>
          </form>
        </div>

        <!-- Hamburger menu untuk mobile -->
        <div class="md:hidden">
          <button type="button" class="text-white hover:text-gray-300 focus:outline-none" id="mobile-menu-button">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>

        <!-- Menu navigasi (kanan) -->
        <div class="hidden md:flex items-center space-x-6" id="navbar-menu">
          <a href="{{ url('/') }}" class="text-white hover:text-yellow-400 font-medium">Home</a>
          <a href="{{ url('/aboutUs') }}" class="text-white hover:text-yellow-400 font-medium">About Us</a>
          <a href="{{ url('/marketplace') }}" class="text-white hover:text-yellow-400 font-medium">Product</a>
          <a href="{{ url('/artikel') }}" class="text-white hover:text-yellow-400 font-medium">Article</a>

          <!-- Login/Logout -->
          @auth
          <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center text-white hover:text-yellow-400 font-medium">
              {{ Auth::user()->name }}
              <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </button>
            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-lg z-10">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">
                  Logout
                </button>
              </form>
            </div>
          </div>
          @else
          <a href="{{ route('login') }}" class="text-white hover:text-yellow-400 font-medium">Login</a>
          @endauth
        </div>
      </div>
    </nav>

    <!-- Search bar untuk mobile (muncul saat menu di-toggle) -->
    <!-- PERBAIKAN: Menggunakan style display none alih-alih class hidden -->
    <div class="md:hidden mt-2 px-4" id="mobile-search" style="display: none;">
      <form action="{{ url('/artikel') }}" method="GET" class="w-full" role="search">
        <div class="relative flex items-center w-full">
          <input type="search" name="search" placeholder="Cari artikel..."
            class="w-full py-2 pl-4 pr-10 text-sm bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-blue-500"
            required />
          <button type="submit" class="absolute right-0 top-0 mt-2 mr-3 text-gray-400 hover:text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </button>
        </div>
      </form>
    </div>
  </header>

  <div class="banner-area banner-bg-artikel">
    <!-- ...kode lainnya... -->
  </div>

  <footer class="bg-[#262828] text-white py-8 mt-16">
    <div class="max-w-6xl mx-auto px-4">
      <div class="flex flex-col md:flex-row justify-between items-center space-y-6 md:space-y-0">

        <!-- Left: Logo / Title -->
        <div class="flex items-center space-x-4 text-center md:text-left">
          <img src="{{ asset('images/logobadui1.webp') }}" alt="Baduy Logo" class="me-10 w-25 h-20 object-contain">
          <div class="text-center md:text-left">
            <h2 class="text-4xl font-bold text-yellow-400">Suku Baduy</h2>
            <p class="text-xl mt-1 text-gray-300">Preserving Culture. Promoting Tradition.</p>
          </div>
        </div>

        <!-- Center: Navigation -->
        <div class="space-x-4 text-2xl">
          <a href="{{ url('/') }}" class="hover:text-yellow-400 transition">Home</a>
          <a href="{{ url('/aboutUs') }}" class="hover:text-yellow-400 transition">About</a>
          <a href="{{ url('/marketplace') }}" class="hover:text-yellow-400 transition">Products</a>
          <a href="{{ url('/artikel') }}" class="hover:text-yellow-400 transition">Article</a>
        </div>

        <!-- Right: Social Media -->
        <div class="flex space-x-4">
          <a href="#" class="hover:text-yellow-400 transition">
            <svg class="w-10 h-8 fill-current" viewBox="0 0 24 24">
              <path d="M22 4.01c-.77.34-1.6.56-2.46.66a4.26 4.26 0 0 0 1.88-2.36c-.83.49-1.74.85-2.7 1.04a4.24 4.24 0 0 0-7.22 3.87 12.01 12.01 0 0 1-8.73-4.43 4.25 4.25 0 0 0 1.31 5.67 4.21 4.21 0 0 1-1.92-.53v.05a4.25 4.25 0 0 0 3.4 4.17 4.28 4.28 0 0 1-1.91.07 4.25 4.25 0 0 0 3.97 2.95 8.5 8.5 0 0 1-5.28 1.82c-.34 0-.68-.02-1.01-.06a12.03 12.03 0 0 0 6.5 1.91c7.8 0 12.07-6.46 12.07-12.07 0-.18 0-.35-.01-.53A8.65 8.65 0 0 0 22 4.01z" />
            </svg>
          </a>
          <a href="#" class="hover:text-yellow-400 transition">
            <svg class="w-10 h-8 fill-current" viewBox="0 0 24 24">
              <path d="M12 2.04c-5.52 0-10 4.47-10 9.98 0 4.41 3.59 8.08 8.27 8.98v-6.36H7.9v-2.62h2.37V9.57c0-2.35 1.38-3.65 3.5-3.65 1.02 0 2.1.18 2.1.18v2.3h-1.18c-1.16 0-1.52.72-1.52 1.45v1.74h2.59l-.41 2.62h-2.18v6.36C18.41 20.1 22 16.43 22 11.98c0-5.5-4.48-9.97-10-9.97z" />
            </svg>
          </a>
        </div>
      </div>

      <div class="border-t border-gray-700 mt-8 pt-4 text-center text-base text-gray-400">
        © Baduy Official. All rights reserved.
      </div>
    </div>
  </footer>

  <!-- Script untuk mobile menu dan search - PERBAIKAN: script yang lebih robust -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const button = document.getElementById('mobile-menu-button');
      const menu = document.getElementById('navbar-menu');
      const mobileSearch = document.getElementById('mobile-search');

      if (button && menu && mobileSearch) {
        button.addEventListener('click', function() {
          // Toggle menu
          menu.classList.toggle('hidden');
          menu.classList.toggle('flex');
          menu.classList.toggle('flex-col');
          menu.classList.toggle('absolute');
          menu.classList.toggle('top-16');
          menu.classList.toggle('left-0');
          menu.classList.toggle('w-full');
          menu.classList.toggle('text-left');
          menu.classList.toggle('bg-gray-800');
          menu.classList.toggle('p-4');
          menu.classList.toggle('rounded');
          menu.classList.toggle('shadow-lg');
          menu.classList.toggle('z-10');

          // Lebih eksplisit untuk search bar
          if (mobileSearch.style.display === 'none') {
            mobileSearch.style.display = 'block';
          } else {
            mobileSearch.style.display = 'none';
          }

          // Styling untuk item menu
          const menuItems = menu.querySelectorAll('a');
          menuItems.forEach(item => {
            item.classList.toggle('block');
            item.classList.toggle('mb-2');
            item.classList.toggle('pl-2');
          });
        });
      }

      // Highlight current page
      const currentPath = window.location.pathname;
      const navLinks = document.querySelectorAll('#navbar-menu a');
      navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
          link.classList.add('text-yellow-400');
          link.classList.add('font-bold');
        }
      });
    });
  </script>

  <!-- Jika pakai Vite, panggilan ini HARUS yang terakhir -->
  @vite(['resources/js/app.js'])
</body>

</html>