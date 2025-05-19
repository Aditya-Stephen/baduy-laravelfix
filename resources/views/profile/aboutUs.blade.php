<!DOCTYPE html>
<html lang="en">

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
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="shortcut icon" href="{{ asset('images/logobadui1.webp') }}" type="image/png" />
    
    <!-- Panggil file CSS dan JavaScript menggunakan Vite -->
    @vite(['resources/js/app.js'])

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="bg-gray-900">
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

   	<div class="banner-area banner-bg-1">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="banner">
						<h2>About Us</h2>
						<ul class="page-title-link">
							<li><a href="#">Home</a></li>
							<li><a href="#">About Us</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

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
        <img src="suasana1.jpg" alt="Baduy Group" class="rounded-lg shadow-md">
      </div>
    </div>
  </section>

  <hr class="border-dashed-gray-600 mx-4 my-8">

  <section class="max-w-7xl mx-auto px-4 pb-12">
    <div class="grid md:grid-cols-2 gap-8 items-center">
      <div>
        <img src="suasana1.jpg" alt="Baduy Village" class="rounded-lg shadow-md">
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
              <svg class="w-10 h-8 fill-current" viewBox="0 0 24 24"><path d="M22 4.01c-.77.34-1.6.56-2.46.66a4.26 4.26 0 0 0 1.88-2.36c-.83.49-1.74.85-2.7 1.04a4.24 4.24 0 0 0-7.22 3.87 12.01 12.01 0 0 1-8.73-4.43 4.25 4.25 0 0 0 1.31 5.67 4.21 4.21 0 0 1-1.92-.53v.05a4.25 4.25 0 0 0 3.4 4.17 4.28 4.28 0 0 1-1.91.07 4.25 4.25 0 0 0 3.97 2.95 8.5 8.5 0 0 1-5.28 1.82c-.34 0-.68-.02-1.01-.06a12.03 12.03 0 0 0 6.5 1.91c7.8 0 12.07-6.46 12.07-12.07 0-.18 0-.35-.01-.53A8.65 8.65 0 0 0 22 4.01z"/></svg>
            </a>
            <a href="#" class="hover:text-yellow-400 transition">
              <svg class="w-10 h-8 fill-current" viewBox="0 0 24 24"><path d="M12 2.04c-5.52 0-10 4.47-10 9.98 0 4.41 3.59 8.08 8.27 8.98v-6.36H7.9v-2.62h2.37V9.57c0-2.35 1.38-3.65 3.5-3.65 1.02 0 2.1.18 2.1.18v2.3h-1.18c-1.16 0-1.52.72-1.52 1.45v1.74h2.59l-.41 2.62h-2.18v6.36C18.41 20.1 22 16.43 22 11.98c0-5.5-4.48-9.97-10-9.97z"/></svg>
            </a>
          </div>
        </div>

        <div class="border-t border-gray-700 mt-8 pt-4 text-center text-base text-gray-400">
          © Baduy Official. All rights reserved.
        </div>
      </div>
    </footer>

    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

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