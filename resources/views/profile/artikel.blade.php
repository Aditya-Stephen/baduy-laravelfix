<!DOCTYPE html>
<html lang="en">

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

<!-- Panggil file CSS dan JavaScript menggunakan Vite -->
@vite(['resources/js/app.js'])


<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <header class="header header_style_01">
        <nav class="megamenu navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/artikel') }}"><img src="images/logobadui1.webp" class="gambar-kecil" alt="image"></a>
                    <!-- fitur searching -->
                    <form action="{{ url('/artikel') }}" method="GET" class="search-container" role="search">
                        <label for="search">Cari artikel</label>
                        <input id="search" type="search" name="search" placeholder="Cari artikel..." required autofocus />
                        <button type="submit">GO</button>
                    </form>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/aboutUs') }}">about us</a></li>
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
            </div>
        </nav>
    </header>

    <div class="banner-area banner-bg-artikel">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner">
                        <h2>Artikel</h2>
                        <ul class="page-title-link">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Artikel</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Kategori Horizontal -->
    <div class="category-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="category-list">
                        <li><a href="#">Trending</a></li>
                        <li><a href="#">Terbaru</a></li>
                        <li><a href="#">Budaya & Tradisi</a></li>
                        <li><a href="#">Kearifan Lokal</a></li>
                        <li><a href="#">Mitos & Kepercayaan</a></li>
                        <li><a href="#">lokasi</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="article-section" class="article-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="article-content">
                        @if(request()->has('search'))
                        @if($articles->isEmpty())
                        <div class="alert alert-warning">
                            Tidak ditemukan hasil untuk: <strong>{{ request('search') }}</strong>
                        </div>
                        @else
                        <div class="alert alert-success">
                            Menampilkan hasil untuk: <strong>{{ request('search') }}</strong>
                        </div>
                        @endif
                        @endif
                        <!-- Artikel Pertama --> <!-- Tampilkan daftar artikel -->
                        @foreach ($articles as $article)
                        <div class="article-post">
                            <div class="author-profile">
                                <img src="{{ $article->profile_picture }}" alt="{{ $article->author_name }}" class="profile-image">
                            </div>
                            <div class="post-content12">
                                <!-- Nama penulis -->
                                <h3>{{ $article->author_name }}</h3>
                                <!-- Judul artikel -->
                                <h4> <a href="{{ route('artikel.show', $article->id) }}" class="title-link">{{ $article->title }}</a> </h4>
                                <!-- Tanggal artikel -->
                                <p class="date">
                                    @if($article->created_at)
                                    {{ $article->created_at->format('F j, Y') }}
                                    @else
                                    Tanggal tidak tersedia
                                    @endif
                                </p>
                                <!-- Potongan isi artikel -->
                                <p>{{ Str::limit($article->content, 150) }}</p>
                                <!-- Link baca lebih banyak -->
                                <a href="{{ route('artikel.show', $article->id) }}" class="read-more">Baca lebih banyak...</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="test-box" class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="testi-carousel owl-carousel owl-theme">
                        <div class="testimonial clearfix">
                            <div class="desc">
                                <h3><i class="fa fa-quote-left"></i> Wonderful Support!</h3>
                                <p class="lead">They have got my project on time with the competition with a sed highly skilled, and experienced & professional team.</p>
                            </div>
                            <div class="testi-meta">
                                <img src="uploads/testi_01.png" alt="" class="img-responsive alignleft">
                                <h4>James Fernando <small>- Manager of Racer</small></h4>
                            </div>
                            <!-- end testi-meta -->
                        </div>
                        <!-- end testimonial -->

                        <div class="testimonial clearfix">
                            <div class="desc">
                                <h3><i class="fa fa-quote-left"></i> Awesome Services!</h3>
                                <p class="lead">Explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you completed.</p>
                            </div>
                            <div class="testi-meta">
                                <img src="uploads/testi_02.png" alt="" class="img-responsive alignleft">
                                <h4>Jacques Philips <small>- Designer</small></h4>
                            </div>
                            <!-- end testi-meta -->
                        </div>
                        <!-- end testimonial -->

                        <div class="testimonial clearfix">
                            <div class="desc">
                                <h3><i class="fa fa-quote-left"></i> Great & Talented Team!</h3>
                                <p class="lead">The master-builder of human happines no one rejects, dislikes avoids pleasure itself, because it is very pursue pleasure. </p>
                            </div>
                            <div class="testi-meta">
                                <img src="uploads/testi_03.png" alt="" class="img-responsive alignleft">
                                <h4>Venanda Mercy <small>- Newyork City</small></h4>
                            </div>
                            <!-- end testi-meta -->
                        </div>
                        <!-- end testimonial -->
                        <div class="testimonial clearfix">
                            <div class="desc">
                                <h3><i class="fa fa-quote-left"></i> Wonderful Support!</h3>
                                <p class="lead">They have got my project on time with the competition with a sed highly skilled, and experienced & professional team.</p>
                            </div>
                            <div class="testi-meta">
                                <img src="uploads/testi_01.png" alt="" class="img-responsive alignleft">
                                <h4>James Fernando <small>- Manager of Racer</small></h4>
                            </div>
                            <!-- end testi-meta -->
                        </div>
                        <!-- end testimonial -->

                        <div class="testimonial clearfix">
                            <div class="desc">
                                <h3><i class="fa fa-quote-left"></i> Awesome Services!</h3>
                                <p class="lead">Explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you completed.</p>
                            </div>
                            <div class="testi-meta">
                                <img src="uploads/testi_02.png" alt="" class="img-responsive alignleft">
                                <h4>Jacques Philips <small>- Designer</small></h4>
                            </div>
                            <!-- end testi-meta -->
                        </div>
                        <!-- end testimonial -->

                        <div class="testimonial clearfix">
                            <div class="desc">
                                <h3><i class="fa fa-quote-left"></i> Great & Talented Team!</h3>
                                <p class="lead">The master-builder of human happines no one rejects, dislikes avoids pleasure itself, because it is very pursue pleasure. </p>
                            </div>
                            <div class="testi-meta">
                                <img src="uploads/testi_03.png" alt="" class="img-responsive alignleft">
                                <h4>Venanda Mercy <small>- Newyork City</small></h4>
                            </div>
                            <!-- end testi-meta -->
                        </div><!-- end testimonial -->
                    </div><!-- end carousel -->
                </div><!-- end col -->
            </div><!-- end row -->

        </div><!-- end container -->
    </div><!-- end section -->

    <div id="testimonials" class="parallax section db parallax-off" style="background-image:url('uploads/parallax_03.jpg');">
        <div class="container">
            <div class="section-title text-center">
                <h3>Our Clients</h3>
                <p class="lead">We thanks for all our awesome testimonials! There are hundreds of our happy customers! <br>Let's see what others say about GoodWEB Solutions website template!</p>
            </div><!-- end title -->

            <hr class="hr1">

            <div class="row logos">
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="uploads/logo_01.png" alt="" class="img-repsonsive"></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="uploads/logo_02.png" alt="" class="img-repsonsive"></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="uploads/logo_03.png" alt="" class="img-repsonsive"></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="uploads/logo_04.png" alt="" class="img-repsonsive"></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="uploads/logo_05.png" alt="" class="img-repsonsive"></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="uploads/logo_06.png" alt="" class="img-repsonsive"></a>
                </div>
            </div><!-- end row -->

        </div><!-- end container -->
    </div><!-- end section -->

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

    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

    <!-- JS Files -->
    <script src="{{ asset('js/all.js') }}"></script>
    <script src="{{ asset('js/portfolio.js') }}"></script>
    <script src="{{ asset('js/hoverdir.js') }}"></script>
    <script src="{{ asset('js/modernizer.js') }}"></script>

    <!-- Panggil custom.js PALING BAWAH -->
    <script src="{{ asset('js/custom.js') }}"></script>

    <!-- Jika pakai Vite, panggilan ini HARUS yang terakhir -->
    @vite(['resources/js/app.js'])

</body>

</html>