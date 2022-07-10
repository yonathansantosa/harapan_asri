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
  <div class="mx-auto my-12 flex h-screen w-4/6 flex-col">
    <div class="flex h-2/5 min-h-min w-full flex-col items-center justify-center bg-indigo-400 text-4xl text-white">

      <h1 class="text-center font-bold">Selamat datang di sistem rekam medis</h1>
      <h1 class="text-center font-bold">Wisma Lansia Harapan Asri</h1>
    </div>
    <div class="mx-auto grid w-full auto-rows-min grid-cols-3 items-center justify-center gap-4 bg-gray-400 p-4">
      {{-- Kepegawaian --}}
      @if (in_array(session()->get('auth_wlha.id_level.0'), [1, 2]))
        @php
          $active = false;
          $svgd = 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4';
        @endphp
        <x-navitem href="{{ route('pegawai.index') }}" :active=$active :svgd=$svgd>
          Kepegawaian
        </x-navitem>
      @endif
      {{-- Penghuni --}}
      @if (in_array(session()->get('auth_wlha.id_level.0'), [1, 2, 3]))
        @php
          $active = false;
          $svgd = 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z';
        @endphp
        <x-navitem href="{{ route('penghuni.index') }}" :active=$active :svgd=$svgd>
          Penghuni
        </x-navitem>
      @endif
      {{-- Rekam Medis --}}
      @if (in_array(session()->get('auth_wlha.id_level.0'), [1, 2, 3, 4]))
        @php
          $active = false;
          $svgd = 'M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z';
        @endphp
        <x-navitem href="{{ route('rekmed.index') }}" :active=$active :svgd=$svgd>
          Rekam Medis
        </x-navitem>
      @endif
      {{-- Farmasi --}}
      @if (in_array(session()->get('auth_wlha.id_level.0'), [1, 2, 6]))
        @php
          $active = false;
          $svgd = 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10';
        @endphp
        <x-navitem href="{{ route('farmasi.index') }}" :active=$active :svgd=$svgd>
          Farmasi
        </x-navitem>
      @endif
      {{-- Fisioterapi --}}
      @if (in_array(session()->get('auth_wlha.id_level.0'), [1, 2]))
        @php
          $active = false;
          $svgd = 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4';
        @endphp
        <x-navitem href="#" :active=$active :svgd=$svgd>
          Fisioterapi
        </x-navitem>
      @endif
      {{-- Mobilitas --}}
      @if (in_array(session()->get('auth_wlha.id_level.0'), [1, 2, 3, 4]))
        @php
          $active = false;
          $svgd = 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z';
        @endphp
        <x-navitem href="{{ route('mobilitas.index') }}" :active=$active :svgd=$svgd>
          Mobilitas
        </x-navitem>
      @endif
      {{-- Inventaris --}}
      @if (in_array(session()->get('auth_wlha.id_level.0'), [1, 2]))
        @php
          $active = false;
          $svgd = 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z';
        @endphp
        <x-navitem href="#" :active=$active :svgd=$svgd>
          Inventaris
        </x-navitem>
      @endif
    </div>
    <div class="mx-auto grid w-full auto-rows-min grid-cols-3 items-center justify-center gap-4 bg-gray-400 p-4">
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
