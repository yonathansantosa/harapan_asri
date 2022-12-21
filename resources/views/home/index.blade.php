<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Sistem Informasi Wisma Harapan Asri</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <!-- Scripts -->
  <script src="{{ asset(mix('js/app.js')) }}"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script> --}}
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
  {{-- <script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script> --}}

  <!-- Ajax -->
  {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" /> --}}

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

  <link rel="stylesheet" href="{{ url('css/select2-tailwind.css') }}">

</head>

<body class="font-sans antialiased">
  <div class="mx-auto flex h-screen w-full flex-col justify-center md:w-4/6">
    <div class="flex h-2/5 min-h-min w-full flex-col items-center justify-center bg-indigo-400 p-8 text-4xl text-white">
      <h1 class="text-center font-bold">Selamat datang di sistem rekam medis</h1>
      <h1 class="text-center font-bold">Wisma Lansia Harapan Asri</h1>
    </div>
    <div class="mx-auto grid w-full auto-rows-min grid-cols-1 items-center justify-center gap-4 bg-gray-400 p-4 sm:grid-cols-2 xl:grid-cols-3">
      @include('layouts.navigationlist')
    </div>
    <div class="mx-auto grid w-full auto-rows-min grid-cols-1 items-center justify-center gap-4 bg-gray-400 p-4 sm:grid-cols-2 xl:grid-cols-3">
      <a href="{{ route('auth.logout') }}"
        class="mt-1 flex items-center space-x-4 rounded-md border-2 border-white bg-white p-2 text-lg font-semibold text-red-400 transition duration-200 hover:border-red-600 hover:text-red-600">
        <svg fill="none" class="mr-4 h-6 w-6"
          stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
          </path>
        </svg>
        Keluar
      </a>
    </div>
  </div>
</body>

</html>
