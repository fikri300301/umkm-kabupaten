<!-- Fonts -->
{{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

<!-- Vendors -->
{{-- <link rel="stylesheet" href="{{ asset('/vendors/perfect-scrollbar/perfect-scrollbar.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('/vendors/bootstrap-icons/bootstrap-icons.css') }}"> --}}
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> --}}

<!-- Styles -->
@vite(['resources/scss/app.scss', 'resources/scss/themes/dark/app-dark.scss', 'resources/js/app.js', 'resources/js/script.js'])
{{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/app-dark.css') }}"> --}}

@livewireStyles
@stack('style')
