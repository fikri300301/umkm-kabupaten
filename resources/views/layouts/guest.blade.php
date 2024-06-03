<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} SIMPLEBOOK</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/js/app.js', 'resources/js/script.js', 'resources/scss/styles.scss'])
    @livewireStyles
    @stack('style')
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="bem,fmipa,unesa,bem fmipa unesa, lomba, event, artikel, blog, album">
    <meta name="author" content="BEM FMIPA UNESA">
    <meta property="og:title" content="{{ config('app.name', 'Laravel') }}">
    <meta property="og:description" content="Website Resmi BEM FMIPA UNESA">
    <meta property="og:image" content="{{ asset('/logo/KABINET.png') }}">
    <meta property="og:url" content="http://bemfmipaunesa.my.id/">
    <meta property="og:site_name" content="BEM FMIPA UNESA">
    <meta name="twitter:card" content="{{ asset('/logo/KABINET.png') }}">
    <meta name="twitter:title" content="{{ config('app.name', 'Laravel') }}">
    <meta name="twitter:description" content="Website Resmi BEM FMIPA UNESA">
    <meta name="twitter:image" content="{{ asset('/logo/KABINET.png') }}">
    <link rel="icon" type ="image/png" href="{{ asset('/logo/KABINET.png') }}">
</head>


<body>
    <div id="app">
        {{-- <div class="container-navbar">
            <nav class="navbar navbar-expand-lg bg-body-tertiary py-1 px-2">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('/logo/UNESA.png') }}" alt="UNESA" height="48">
                    <img src="{{ asset('/logo/BEM.png') }}" alt="BEM FMIPA UNESA" height="48">
                    <img src="{{ asset('/logo/KABINET.png') }}" alt="KABINET BEM FMIPA UNESA" height="48">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end mt-4 mt-md-0" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item ms-4 mb-2 mb-md-0">
                            <a class="nav-link-primary isUrl" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item dropdown ms-4 mb-2 mb-md-0">
                            <a class="nav-link-primary dropdown-toggle " href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Tentang Kami
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown"
                                style="background-color: #D0E8FF;">
                                <li class="mb-2"><a class="dropdown-item"
                                        href="{{ route('profile-bem-front') }}">Profil</a>
                                </li>
                                <li class="mb-2"><a class="dropdown-item"
                                    href="/profile-bem#struktur-kabinet">Divisi</a>
                            </li>
                            </ul>
                        </li>

                        <li class="nav-item ms-4 mb-2 mb-md-0">
                            <a class="nav-link-primary" href="{{ route('article') }}">Artikel</a>
                        </li>
                        <li class="nav-item ms-4 mb-2 mb-md-0">
                            <a class="nav-link-primary" href="{{ route('galeri') }}">Galeri</a>
                        </li>
                        <li class="nav-item ms-4 mb-2 mb-md-0">
                            <a class="nav-link-primary" href="{{ route('event') }}">Event</a>
                        </li>
                        @guest
                            @php
                                $text = 'login';
                            @endphp
                        @endguest

                        @auth
                            @php
                                $text = 'login';
                                if (!Auth::user()->hasRole('pengguna')) {
                                    $text = 'dashboard';
                                } else {
                                    $text = 'account';
                                }
                            @endphp
                        @endauth

                        <li class="nav-item ms-4 mb-2 mb-md-0">
                            <a class="btn btn-outline-primary-login rounded-pill px-3"
                                href="/{{ $text }}">{{ ucfirst($text) }}</a>
                        </li>
                        @auth
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="mx-4 btn btn-warning rounded-pill px-3">Logout</button>
                                </form>
                            </li>
                        @endauth
                        @guest
                            <li class="nav-item ms-4 mb-2 mb-md-0">
                                <a class="btn btn-primary rounded-pill px-3" href="/register">Register</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </div> --}}

        <x-session-message.session-message />
        <main class="">
            {{ $slot }}
        </main>
        {{-- <footer>
            <div class="container">
                <hr>
                <div class="row align-items-center py-5">
                    <div class="col-12 col-md-4 mb-3 mb-md-0 d-flex justify-content-center">
                        <img src="{{ asset('/logo/Logo_footer.png') }}" alt="">
                    </div>
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <div class="sosial-media">
                            <a href="" class="text-reset me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33"
                                    fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                    <path
                                        d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <div class="d-flex align-items-center gap-3">
                            <p class="fs-2"><i class="bi bi-geo-alt "></i></p>
                            <p class="ml-2">MPMG+VWR, Jl. Ketintang, Ketintang, Kec. Gayungan, Surabaya, Jawa Timur 60231</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <p class="fs-2"><i class="bi bi-telephone"></i></p>
                            <a href="https://wa.me/+6287861601254" class="text-reset text-decoration-none"><p class="ml-2">087861601254</p></a>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <p class="fs-2"><i class="bi bi-envelope"></i></p>
                            <p class="ml-2">business@bem.fmipa.unesa.ac.id</p>
                        </div>
                    </div>
                </div>
                <hr>
                <p class="text-center">©2023 BEM FMIPA UNESA.</p>
            </div>
        </footer> --}}

    </div>
    @livewireScripts
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-3HNEKT9QTK"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-3HNEKT9QTK');
    </script>
</body>

</html>
