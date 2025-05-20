<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Baduy Product</title>
    <link rel="shortcut icon" href="{{ asset('images/logobadui1.webp') }}" type="image/png" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white">
    <header class="header header_style_01">
        <nav class="megamenu navbar navbar-default">
            <div class="container-fluid">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><img src="images/logobadui1.webp" class="gambar-kecil" alt="image"></a>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/aboutUs') }}">About Us</a></li>
                    <li><a href="{{ url('/marketplace') }}">Product</a></li>
                    <li><a href="{{ url('/artikel') }}">Article</a></li>
                    <!-- Menampilkan nama pengguna setelah login, atau tombol login jika belum login -->
                    @auth
                    <!-- Menampilkan nama pengguna yang login dengan menu dropdown -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link" style="text-decoration: none; color: inherit;">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <!-- Jika belum login, tampilkan tombol login -->
                    <li><a href="{{ route('login') }}">Login</a></li>
                    @endauth
                </ul>
            </div>
        </nav>
    </header>
    <div class="container">
        <section class="text-center py-12 bg-gray-800">
            <h1 class="text-4xl font-bold text-orange-400">Produk Suku Baduy</h1>
            <p class="text-gray-300 mt-2">Produk khas Suku Baduy yang dibuat secara tradisional dengan bahan alami.</p>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
            <div class="bg-gray-700 p-4 rounded-lg shadow-lg">
                <img src="images/kain3.jpg" alt="Kain Tenun Baduy" class="rounded-lg w-full h-40 object-cover">
                <h2 class="text-lg font-semibold mt-4">Kain Tenun Baduy</h2>
                <p class="text-gray-300">Kain tenun khas yang dibuat secara tradisional oleh masyarakat Baduy.</p>
            </div>
            <div class="bg-gray-700 p-4 rounded-lg shadow-lg">
                <img src="images/tasbadui.jpg" alt="Tas Anyaman Bambu" class="rounded-lg w-full h-40 object-cover">
                <h2 class="text-lg font-semibold mt-4">Tas Anyaman Bambu</h2>
                <p class="text-gray-300">Kerajinan tangan berbahan dasar bambu dengan desain khas.</p>
            </div>
            <div class="bg-gray-700 p-4 rounded-lg shadow-lg">
                <img src="images/aksesorisbadui.jpg" alt="Aksesoris Tradisional" class="rounded-lg w-full h-40 object-cover">
                <h2 class="text-lg font-semibold mt-4">Aksesoris Tradisional</h2>
                <p class="text-gray-300">Kalung dan gelang khas yang melambangkan identitas budaya Baduy.</p>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
            <div class="bg-gray-700 p-4 rounded-lg shadow-lg">
                <img src="images/kain4.jpg" alt="Kain Tenun Baduy" class="rounded-lg w-full h-40 object-cover">
                <h2 class="text-lg font-semibold mt-4">Sarung Baduy</h2>
                <p class="text-gray-300">Kain sarung dengan motif unik yang sering dipakai oleh masyarakat Baduy.</p>
            </div>
            <div class="bg-gray-700 p-4 rounded-lg shadow-lg">
                <img src="images/topibadui.webp" alt="Tas Anyaman Bambu" class="rounded-lg w-full h-40 object-cover">
                <h2 class="text-lg font-semibold mt-4">Topi Baduy (Koja)</h2>
                <p class="text-gray-300">Penutup kepala khas yang sering digunakan oleh masyarakat Baduy Luar.</p>
            </div>
            <div class="bg-gray-700 p-4 rounded-lg shadow-lg">
                <img src="images/kerajinanbadui.jpeg" alt="Aksesoris Tradisional" class="rounded-lg w-full h-40 object-cover">
                <h2 class="text-lg font-semibold mt-4">Kerajinan Kayu</h2>
                <p class="text-gray-300">Berbagai benda dari kayu seperti sendok, piring, atau ukiran dengan sentuhan khas.</p>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
            <div class="bg-gray-700 p-4 rounded-lg shadow-lg">
                <img src="images/obatherbalbadui.jpg" alt="Kain Tenun Baduy" class="rounded-lg w-full h-40 object-cover">
                <h2 class="text-lg font-semibold mt-4">Obat Herbal Tradisional</h2>
                <p class="text-gray-300"> Ramuan obat dari tumbuhan hutan yang dipercaya memiliki berbagai khasiat.</p>
            </div>
            <div class="bg-gray-700 p-4 rounded-lg shadow-lg">
                <img src="images/gulabadui.jpg" alt="Tas Anyaman Bambu" class="rounded-lg w-full h-40 object-cover">
                <h2 class="text-lg font-semibold mt-4">Gula Aren Badui</h2>
                <p class="text-gray-300">Kerajinan tangan berbahan dasar bambu dengan desain khas.</p>
            </div>
            <div class="bg-gray-700 p-4 rounded-lg shadow-lg">
                <img src="images/madubadui.jpeg" alt="Aksesoris Tradisional" class="rounded-lg w-full h-40 object-cover">
                <h2 class="text-lg font-semibold mt-4">Madu Hutan Baduy</h2>
                <p class="text-gray-300">Madu alami yang dihasilkan dari lebah liar di hutan sekitar pemukiman Baduy.</p>
            </div>
        </section>
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

    <!-- ALL JS FILES -->
    <script src="{{ asset('js/all.js') }}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/portfolio.js') }}"></script>
    <script src="{{ asset('js/hoverdir.js') }}"></script>
    <script src="{{ asset('js/modernizer.js') }}"></script>
    <!-- jika pake vite -->
    @vite(['resources/js/app.js'])
</body>

</html>