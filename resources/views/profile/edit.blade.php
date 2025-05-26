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
                  @if(Auth::user()->profile_photo_path)
                      <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" class="w-8 h-8 rounded-full mr-2 object-cover">
                  @else
                      <div class="w-8 h-8 rounded-full bg-gray-600 mr-2 flex items-center justify-center text-white">
                          {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                      </div>
                  @endif
                  {{ Auth::user()->name }}
                  <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                  </svg>
              </button>
              <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-lg z-10">
                  <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                      Edit Profile
                  </a>
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


    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Profile</h1>
                
                @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="profile_photo">
                            Profile Photo
                        </label>
                        <div class="flex items-center">
                            @if(auth()->user()->profile_photo_path)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" 
                                    class="w-20 h-20 rounded-full object-cover mr-4">
                            @else
                                <div class="w-20 h-20 rounded-full bg-gray-300 mr-4 flex items-center justify-center text-gray-600 text-2xl font-bold">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <input type="file" name="profile_photo" id="profile_photo" 
                                class="border rounded py-2 px-3 text-gray-700">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Full Name
                        </label>
                        <input class="border rounded w-full py-2 px-3 text-gray-700" 
                            id="name" name="name" type="text" 
                            value="{{ old('name', auth()->user()->name) }}" required>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-lg shadow p-6 mt-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Your Articles</h2>
                
                @if($articles->isEmpty())
                    <p class="text-gray-600">You haven't submitted any articles yet.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Title
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($articles as $article)
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        {{ Str::limit($article->title, 40) }}
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        @if($article->status === 'approved')
                                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                                Approved
                                            </span>
                                        @elseif($article->status === 'pending')
                                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">
                                                Pending Review
                                            </span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">
                                                Rejected
                                            </span>
                                            @if($article->rejection_reason)
                                                <p class="text-xs text-gray-600 mt-1">
                                                    Reason: {{ $article->rejection_reason }}
                                                </p>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        {{ $article->created_at->format('M d, Y') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @vite(['resources/js/app.js'])
</body>

</html>
