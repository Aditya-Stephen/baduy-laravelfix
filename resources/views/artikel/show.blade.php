<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <!-- Site Metas -->
  <title>{{ $article->title }} - Baduy</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- font tambahan -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Site Icons -->
  <link rel="shortcut icon" href="{{ asset('images/logobadui1.webp') }}" type="image/png" />
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

        <!-- Navigation Menu (tengah) -->
        <div class="hidden md:flex items-center space-x-8">
          <a href="{{ url('/') }}" class="text-white hover:text-yellow-400 transition-colors duration-300">Home</a>
          <a href="{{ route('artikel') }}" class="text-yellow-400 font-semibold">Artikel</a>
          <a href="{{ route('marketplace') }}" class="text-white hover:text-yellow-400 transition-colors duration-300">Marketplace</a>
          <a href="{{ route('aboutUs') }}" class="text-white hover:text-yellow-400 transition-colors duration-300">About Us</a>
        </div>

        <!-- User Menu (kanan) -->
        <div class="flex items-center space-x-4">
          @auth
            <div class="relative group">
              <button class="flex items-center space-x-2 text-white hover:text-yellow-400 transition-colors duration-300">
                <span class="hidden sm:block">{{ Auth::user()->name }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>
              
              <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                <div class="py-1">
                  @if(Auth::user()->role === 'superadmin')
                    <a href="{{ route('superadmin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Super Admin Dashboard</a>
                  @elseif(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Admin Dashboard</a>
                  @endif
                  <a href="{{ route('artikel.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Tulis Artikel</a>
                  <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit Profile</a>
                  <div class="border-t border-gray-100"></div>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                      Logout
                    </button>
                  </form>
                </div>
              </div>
            </div>
          @else
            <a href="{{ route('login') }}" class="text-white hover:text-yellow-400 transition-colors duration-300">Login</a>
            <a href="{{ route('register') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-md transition-colors duration-300">Register</a>
          @endauth
        </div>
      </div>
    </nav>
  </header>

  <!-- Status Info untuk Pemilik Artikel (jika artikel pending/rejected) -->
  @if(Auth::check() && Auth::id() === $article->user_id && $article->status !== 'approved')
  <div class="bg-{{ $article->status === 'pending' ? 'yellow' : 'red' }}-500 text-white py-2 px-4 text-center">
    <span class="font-bold">
      @if($article->status === 'pending')
        ⏳ Artikel Anda sedang menunggu review dari admin
      @else
        ❌ Artikel Anda ditolak: {{ $article->rejection_reason ?? 'Tidak ada alasan yang diberikan' }}
      @endif
    </span>
  </div>
  @endif

  <!-- Main Content -->
  <main class="container mx-auto px-4 py-8">
    <!-- Article Header -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
      <!-- Header Image -->
      @if($article->headerImage())
      <div class="h-64 md:h-96 overflow-hidden">
        <img src="{{ route('image.show', $article->headerImage()->id) }}" 
            alt="{{ $article->title }}" 
            class="w-full h-full object-cover">
      </div>
      @endif

      <!-- Article Info -->
      <div class="p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
          <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">{{ $article->title }}</h1>
            <div class="flex flex-wrap items-center gap-4 text-gray-600">
              <span class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                {{ $article->user->name }}
              </span>
              <span class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ $article->created_at->format('d M Y, H:i') }}
              </span>
              <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                {{ $article->genre }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Article Content -->
    <div class="bg-white rounded-lg shadow-lg p-6">
      <div class="prose max-w-none">
        {!! $article->content !!}
      </div>
      
      <!-- Gallery Images -->
      @if($article->galleryImages->count() > 0)
      <div class="mt-8">
        <h3 class="text-xl font-bold mb-4">Gallery</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
          @foreach($article->galleryImages as $image)
            <div class="aspect-square overflow-hidden rounded-lg">
              <img src="{{ route('image.show', $image->id) }}" 
                   alt="Gallery Image" 
                   class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
            </div>
          @endforeach
        </div>
      </div>
      @endif
    </div>

    <!-- Back Button -->
    <div class="mt-8 text-center">
      <a href="{{ route('artikel') }}" 
          class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors duration-300">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Kembali ke Daftar Artikel
      </a>
    </div>
  </main>

  <footer class="bg-[#262828] text-white py-8 mt-16">
    <div class="container mx-auto px-4 text-center">
      <p>&copy; 2024 Suku Baduy. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>