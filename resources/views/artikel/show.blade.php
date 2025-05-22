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
                    <a class="navbar-brand" href="{{ url('/artikel') }}">
                        <img src="{{ asset('images/logobadui1.webp') }}" class="gambar-kecil" alt="image">
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/aboutUs') }}">about us</a></li>
                        <li><a href="{{ url('/marketplace') }}">Product</a></li>
                        <li><a href="{{ url('/artikel') }}">Article</a></li>
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="article-detail-section">
        <div class="back-button12-container">
          <a href="{{ route('artikel') }}" class="styled-wrapper back-button12">
            <button class="button12">
              <div class="button12-box">
                <span class="button12-elem">
                  <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="arrow-icon">
                    <path fill="black" d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"></path>
                  </svg>
                </span>
                <span class="button12-elem">
                  <svg fill="black" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="arrow-icon">
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"></path>
                  </svg>
                </span>
              </div>
            </button>
          </a>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="article-detail-content">
                        @if($article->header_image)
                            <div class="header-image">
                                <img src="{{ asset($article->header_image) }}" alt="Header Image" class="img-fluid">
                            </div>
                        @endif
                        <div class="article-post">
                            <div class="post-content">
                                <h1>{{ $article->title }}</h1>
                                <p class="meta-info">Published by {{ $article->user->name  }} on {{ $article->created_at->format('F j, Y') }}</p>
                                <div class="article-full-content">
                                    {!! nl2br(e($article->content)) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="to-top-button-container">
        <button class="button12 to-top-btn" title="Back to top">
        <div class="button12-box">
            <span class="button12-elem">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="arrow-icon">
                <path d="M12 4l-8 8 1.41 1.41L12 6.83l6.59 6.58L20 12l-8-8z"></path>
            </svg>
            </span>
        </div>
        </button>
    </div>    
    <script>
    document.querySelector('.to-top-btn').addEventListener('click', () => {
        window.scrollTo({
        top: 0,
        behavior: 'smooth'
        });
    });
    </script>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <img src="images/logobadui1.webp" class="gambar-kecil" alt="" />
                        </div>
                        <p> Integer rutrum ligula eu dignissim laoreet. Pellentesque venenatis nibh sed tellus faucibus bibendum. Sed fermentum est vitae rhoncus molestie. Cum sociis natoque penatibus et magnis dis montes.</p>
                        <p>Sed fermentum est vitae rhoncus molestie. Cum sociis natoque penatibus et magnis dis montes.</p>
                    </div><!-- end clearfix -->
                </div><!-- end col -->

				<div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>Pages</h3>
                        </div>

                        <ul class="footer-links hov">
                        <li><a class="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/aboutUs') }}">About Us</a></li>
                        <li><a href="{{ url('/marketplace') }}">Product</a></li>
                        <li><a href="{{ url('/artikel') }}">Article</a></li>
                        </ul><!-- end links -->
                    </div><!-- end clearfix -->
                </div><!-- end col -->
				
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="footer-distributed widget clearfix">
                        <div class="widget-title">
                            <h3>Subscribe</h3>
							<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which one know this tricks.</p>
                        </div>
						
						<div class="footer-right">
							<form method="get" action="#">
								<input placeholder="Subscribe our newsletter.." name="search">
								<i class="fa fa-envelope-o"></i>
							</form>
						</div>                        
                    </div><!-- end clearfix -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </footer><!-- end footer -->

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