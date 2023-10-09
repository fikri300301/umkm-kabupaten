<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>SIMPLEBOOK</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    @include('layouts.partials.styles')
    {{-- <meta name="description" content="Website Resmi BEM FMIPA UNESA">
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
    <meta name="twitter:image" content="{{ asset('/logo/KABINET.png') }}"> --}}
    {{-- <link rel="icon" type ="image/png" href="{{ asset('/logo/KABINET.png') }}"> --}}
</head>

<body>
    <div id="app">
        <x-side-bar-dashboard/>
        <div id="main" class='layout-navbar'>
            @include('layouts.partials.header')
            <div id="main-content">
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                {{ $header }}
                            </div>
                            <div class="col-12 col-md-6 order-md-2 d-none d-md-block order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        {{-- @foreach (Request::instance()->segments() as $item)
                                            <li class="breadcrumb-item @if ($loop->last) active @endif" aria-current="page"><a class="@if ($loop->last) text-muted @endif" href="{{ route($item) ?? 'asda' }}">{{ $item }}</a></li>
                                        @endforeach --}}

                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                    <x-session-message.session-message/>
                        {{ $slot }}
                    </section>
                </div>

                @include('layouts.partials.footer')
            </div>
        </div>
    </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @include('layouts.partials.scripts')
</body>

</html>
