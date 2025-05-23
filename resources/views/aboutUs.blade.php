<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <!-- Site Metas -->
  <title>About Baduy</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="{{ asset('images/logobadui1.webp') }}" type="image/png" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-900">
  <header class="sticky top-0 z-50 header header_style_01 bg-gray-800 py-2">
    <nav class="container mx-auto px-4">
      <div class="flex items-center justify-between">
        <!-- Logo (kiri) -->
        <div class="flex-shrink-0">
          <a href="{{ url('/') }}" class="flex items-center">
            <img src="images/logobadui1.webp" class="h-14 w-auto object-contain" alt="Baduy Logo">
          </a>
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
  </header>

  <main class="flex-grow">
    <section class="max-w-7xl mx-auto px-4 py-12">
      <div class="grid md:grid-cols-2 gap-8 items-center">
        <div>
          <h2 class="text-sm text-blue-300 uppercase font-semibold mb-2">About Baduy</h2>
          <h1 class="text-3xl text-yellow-400 font-bold mb-4">Welcome to Suku Baduy</h1>
          <p class="italic text-gray-300 mb-4">
            The Baduy are an indigenous community in Indonesia, living in Banten Province. They are known for their simple and traditional way of life, avoiding modern technology and following strict customs.
          </p>
          <p class="text-gray-300 mb-6">
            The Baduy community, with their rich cultural heritage and long-preserved traditions, seeks to introduce their local wisdom to a wider audience. Through broader promotion, they hope that their traditional values, handcrafted products such as weaving, weaving crafts, and natural goods can become more recognized and appreciated by the general public. This way, not only will their culture remain preserved, but it will also provide economic benefits for their community, opening new opportunities in trade while maintaining the principles of sustainability and environmental preservation that they deeply uphold.
          </p>
          <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Learn More</button>
        </div>
        <div>
          <img src="{{ asset('images/suasana1.jpg') }}" alt="Baduy Group" class="rounded-lg shadow-md">
        </div>
      </div>
    </section>

    <hr class="border-dashed-gray-600 mx-4 my-8">

    <section class="max-w-7xl mx-auto px-4 pb-12">
      <div class="grid md:grid-cols-2 gap-8 items-center">
        <div>
          <img src="{{ asset('images/suasana1.jpg') }}" alt="Baduy Village" class="rounded-lg shadow-md">
        </div>
        <div>
          <h2 class="text-sm text-blue-300 uppercase font-semibold mb-2">Konten</h2>
          <h1 class="text-2xl text-yellow-400 font-bold mb-4">Konten</h1>
          <p class="italic text-gray-300 mb-4">
            Quisque eget nisl id nulla sagittis auctor quis id. Aliquam quis vehicula enim, non aliquam risus. Sed a tellus quis mi rhoncus dignissim.
          </p>
          <p class="text-gray-300 mb-6">
            Integer rutrum ligula eu dignissim laoreet. Pellentesque venenatis nibh sed tellus faucibus bibendum. Sed fermentum est vitae rhoncus molestie. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed vitae rutrum neque. Ut id erat sit amet libero bibendum aliquam. Donec ac egestas libero, eu bibendum risus. Phasellus et congue justo.
          </p>
          <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Learn More</button>
        </div>
      </div>
    </section>
  </main>

  <footer class="bg-[#262828] text-white py-8 mt-16">
    <div class="max-w-6xl mx-auto px-4">
      <div class="flex flex-col md:flex-row justify-between items-center space-y-6 md:space-y-0">

        <!-- Left: Logo / Title -->
        <div class="flex items-center space-x-4 text-center md:text-left">
          <img src="{{ asset('images/logobadui1.webp') }}" alt="Baduy Logo" class="me-10 w-10 h-10 object-contain">
          <div class="text-center md:text-left">
            <h2 class="text-sm font-bold text-yellow-400">Suku Baduy</h2>
            <p class="text-xs mt-1 text-gray-300">Preserving Culture. Promoting Tradition.</p>
          </div>
        </div>

        <!-- Center: Navigation -->
        <div class="space-x-4 text-sm">
          <a href="{{ url('/') }}" class="hover:text-yellow-400 transition">Home</a>
          <a href="{{ url('/aboutUs') }}" class="hover:text-yellow-400 transition">About</a>
          <a href="{{ url('/marketplace') }}" class="hover:text-yellow-400 transition">Products</a>
          <a href="{{ url('/artikel') }}" class="hover:text-yellow-400 transition">Article</a>
        </div>

        <!-- Right: Social Media -->
        <div class="flex space-x-4">
          <a href="#" class="hover:text-yellow-400 transition">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
              <path d="M22 4.01c-.77.34-1.6.56-2.46.66a4.26 4.26 0 0 0 1.88-2.36c-.83.49-1.74.85-2.7 1.04a4.24 4.24 0 0 0-7.22 3.87 12.01 12.01 0 0 1-8.73-4.43 4.25 4.25 0 0 0 1.31 5.67 4.21 4.21 0 0 1-1.92-.53v.05a4.25 4.25 0 0 0 3.4 4.17 4.28 4.28 0 0 1-1.91.07 4.25 4.25 0 0 0 3.97 2.95 8.5 8.5 0 0 1-5.28 1.82c-.34 0-.68-.02-1.01-.06a12.03 12.03 0 0 0 6.5 1.91c7.8 0 12.07-6.46 12.07-12.07 0-.18 0-.35-.01-.53A8.65 8.65 0 0 0 22 4.01z" />
            </svg>
          </a>
          <a href="#" class="hover:text-yellow-400 transition">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
              <path d="M12 2.04c-5.52 0-10 4.47-10 9.98 0 4.41 3.59 8.08 8.27 8.98v-6.36H7.9v-2.62h2.37V9.57c0-2.35 1.38-3.65 3.5-3.65 1.02 0 2.1.18 2.1.18v2.3h-1.18c-1.16 0-1.52.72-1.52 1.45v1.74h2.59l-.41 2.62h-2.18v6.36C18.41 20.1 22 16.43 22 11.98c0-5.5-4.48-9.97-10-9.97z" />
            </svg>
          </a>
        </div>
      </div>

      <div class="border-t border-gray-700 mt-8 pt-4 text-center text-sm text-gray-400">
        © Baduy Official. All rights reserved.
      </div>
    </div>
  </footer>

  <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>


  <!-- JS FILES -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const button = document.getElementById('mobile-menu-button');
      const menu = document.getElementById('navbar-menu');

      button.addEventListener('click', function() {
        menu.classList.toggle('hidden');
        menu.classList.toggle('flex');
        menu.classList.toggle('flex-col');
        menu.classList.toggle('absolute');
        menu.classList.toggle('top-16');
        menu.classList.toggle('right-0'); // Ubah right-4 menjadi left-0
        menu.classList.toggle('text-right'); // Tambahkan text-left untuk rata kiri
        menu.classList.toggle('bg-gray-800');
        menu.classList.toggle('p-4');
        menu.classList.toggle('rounded');
        menu.classList.toggle('shadow-lg');
        menu.classList.toggle('z-10');

        // Tambahkan spacing untuk item menu mobile
        const menuItems = menu.querySelectorAll('a');
        menuItems.forEach(item => {
          item.classList.toggle('block');
          item.classList.toggle('mb-2');
          item.classList.toggle('pl-2');
        });
      });
    });
  </script>
  @vite(['resources/js/app.js'])


</body>

</html>