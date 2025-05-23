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

<body class="bg-gray-100">
  <header class="header header_style_01 bg-gray-800 py-2">
    <nav class="container mx-auto px-4">
      <div class="flex items-center justify-between">
        <!-- Logo (kiri) -->
        <div class="flex-shrink-0">
          <a href="{{ url('/') }}" class="flex items-center">
            <img src="{{ asset('images/logobadui1.webp') }}" class="h-12 w-auto object-contain" alt="Baduy Logo">
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

    <div class="min-h-screen bg-gradient-to-br from-[#305792] to-[#313a4d]">
        <div class="max-w-3xl mx-auto px-4 py-12">
            <div class="bg-white/90 backdrop-blur-lg rounded-2xl shadow-2xl p-8 md:p-12 transition-all duration-300 hover:shadow-3xl">
                <h2 class="text-4xl font-bold text-center mb-8 bg-gradient-to-r from-[#305792] to-[#4CAF50] bg-clip-text text-transparent">
                    ✏️ Buat Artikel Baru
                </h2>

                <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">                    
                    @csrf

                    <!-- Input Judul -->
                    <div class="space-y-2">
                        <label class="block text-lg font-medium text-gray-700">Judul Artikel</label>
                        <input type="text" id="title" name="title" required
                            class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl text-lg focus:border-[#4CAF50] focus:ring-2 focus:ring-[#4CAF50]/30 transition-all placeholder-gray-400"
                            placeholder="Masukkan judul menarik disini...">
                    </div>

                    <!-- Input Kategori -->
                    <div class="space-y-2">
                        <label class="block text-lg font-medium text-gray-700">Kategori Artikel</label>
                        <div class="relative">
                            <select id="genre" name="genre" required
                                class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl appearance-none bg-white text-lg focus:border-[#4CAF50] focus:ring-2 focus:ring-[#4CAF50]/30 transition-all">
                                <option value="">Pilih Kategori</option>
                                <option value="Budaya & Tradisi">Budaya & Tradisi</option>
                                <option value="Kearifan Lokal">Kearifan Lokal</option>
                                <option value="Mitos & Kepercayaan">Mitos & Kepercayaan</option>
                                <option value="Lokasi">Lokasi</option>
                            </select>
                            <div class="absolute inset-y-0 right-6 flex items-center pointer-events-none">
                                <svg class="w-1 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Input Gambar Header -->
                    <div class="space-y-2">
                        <label class="block text-lg font-medium text-gray-700">Upload Gambar Header</label>
                        <input type="file" id="header_image" name="header_image" accept="image/*"
                            class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl text-lg focus:border-[#4CAF50] focus:ring-2 focus:ring-[#4CAF50]/30 transition-all">
                        <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, JPEG. Maksimal 3MB</p>
                    </div>

                    <!-- Input Konten -->
                    <div class="space-y-2">
                        <label class="block text-lg font-medium text-gray-700">Isi Artikel</label>
                        <textarea id="content" name="content" rows="12" required
                            class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl text-lg focus:border-[#4CAF50] focus:ring-2 focus:ring-[#4CAF50]/30 transition-all placeholder-gray-400 resize-none"
                            placeholder="Tulis konten artikelmu disini..."></textarea>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit"
                        class="w-full py-5 px-8 bg-gradient-to-r from-[#4CAF50] to-[#305792] text-white text-xl font-semibold rounded-xl shadow-lg hover:shadow-xl hover:scale-[1.02] transition-all transform duration-300 active:scale-95">
                        📤 Publikasikan Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>