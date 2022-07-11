{{-- Accounts --}}
@if (in_array(session()->get('auth_wlha.id_level.0'), [1, 2]))
  @php
    $active = in_array('accounts', $routes_name) ? true : false;
    $svgd = 'M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z';
  @endphp
  <x-navitem href="{{ route('accounts.index') }}" :active=$active :svgd=$svgd>
    Accounts
  </x-navitem>
@endif
{{-- Kepegawaian --}}
@if (in_array(session()->get('auth_wlha.id_level.0'), [1, 2]))
  @php
    $active = in_array('pegawai', $routes_name) ? true : false;
    $svgd = 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4';
  @endphp
  <x-navitem href="{{ route('pegawai.index') }}" :active=$active :svgd=$svgd>
    Kepegawaian
  </x-navitem>
@endif
{{-- Penghuni --}}
@if (in_array(session()->get('auth_wlha.id_level.0'), [1, 2, 3]))
  @php
    $active = in_array('penghuni', $routes_name) ? true : false;
    $svgd = 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z';
  @endphp
  <x-navitem href="{{ route('penghuni.index') }}" :active=$active :svgd=$svgd>
    Penghuni
  </x-navitem>
@endif
{{-- Rekam Medis --}}
@if (in_array(session()->get('auth_wlha.id_level.0'), [1, 2, 3, 4]))
  @php
    $active = in_array('rekmed', $routes_name) ? true : false;
    $svgd = 'M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z';
  @endphp
  <x-navitem href="{{ route('rekmed.index') }}" :active=$active :svgd=$svgd>
    Rekam Medis
  </x-navitem>
@endif
{{-- Farmasi --}}
@if (in_array(session()->get('auth_wlha.id_level.0'), [1, 2, 6]))
  @php
    $active = in_array('farmasi', $routes_name) ? true : false;
    $svgd = 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10';
  @endphp
  <x-navitem href="{{ route('farmasi.index') }}" :active=$active :svgd=$svgd>
    Farmasi
  </x-navitem>
@endif
{{-- Asuhan Keperawatan --}}
@if (in_array(session()->get('auth_wlha.id_level.0'), [1, 2]))
  @php
    $active = in_array('inventaris', $routes_name) ? true : false;
    $svgd = 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z';
  @endphp
  <x-navitem href="{{ route('askep.index') }}" :active=$active :svgd=$svgd>
    Asuhan Keperawatan
  </x-navitem>
@endif
{{-- Fisioterapi --}}
@if (in_array(session()->get('auth_wlha.id_level.0'), [1, 2]))
  @php
    $active = in_array('fisioterapi', $routes_name) ? true : false;
    $svgd = 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4';
  @endphp
  <x-navitem href="#" :active=$active :svgd=$svgd>
    Fisioterapi
  </x-navitem>
@endif
{{-- Mobilitas --}}
@if (in_array(session()->get('auth_wlha.id_level.0'), [1, 2, 3, 4]))
  @php
    $active = in_array('mobilitas', $routes_name) ? true : false;
    $svgd = 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z';
  @endphp
  <x-navitem href="{{ route('mobilitas.index') }}" :active=$active :svgd=$svgd>
    Mobilitas
  </x-navitem>
@endif
{{-- Inventaris --}}
@if (in_array(session()->get('auth_wlha.id_level.0'), [1, 2]))
  @php
    $active = in_array('inventaris', $routes_name) ? true : false;
    $svgd = 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z';
  @endphp
  <x-navitem href="#" :active=$active :svgd=$svgd>
    Inventaris
  </x-navitem>
@endif
