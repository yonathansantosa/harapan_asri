{{-- <div class="hidden" id="mobile-navbar">
  <div class="flex w-full h-12 w-12 m-2 static items-stretch">
    <a href="#" @click="sidebarOpen = ! sidebarOpen"
      class="flex items-center bg-indigo-600 rounded-md space-x-4 text-white font-semibold text-lg hover:text-indigo-600 transition duration-200">
      <svg class="w-6 h-6 mr-4 text-white hover:text-indigo-600 transition duration-200" fill="none"
                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                </path>
            </svg>
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list w-6 h-6 mx-2 text-white" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
</svg>
</a>
<div class="flex items-center justify-center w-full">
  <h1 class="text-2xl font-bold uppercase text-center text-indigo-500 tracking-wide">ASKEP</h1>
</div>
</div>
</div> --}}
{{-- START: Button Menu --}}
<div class="fixed">
  <a href="#" @click="sidebarOpen = ! sidebarOpen"
     class="mt-2 ml-2 mb-auto h-12 w-12 items-center space-x-4 rounded-md bg-indigo-400 text-lg font-semibold text-white transition duration-200 hover:bg-indigo-600 hover:text-indigo-600" :class="sidebarOpen ? 'hidden' : 'flex'">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list m-auto h-6 w-6 text-white" viewBox="0 0 16 16" :class="sidebarOpen ? 'hidden' : ''">
      <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill m-auto text-white" viewBox="0 0 16 16" :class="sidebarOpen ? '' : 'hidden'">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
    </svg>
  </a>
</div>
{{-- END: Button Menu --}}
<?php $routes_name = explode('.', Route::currentRouteName()); ?>
{{-- START: Side Navbar --}}
<template x-if="sidebarOpen">
  <div class="fixed z-50 flex h-full w-full bg-white sm:w-auto"
       x-transition:enter="transition origin-left duration-200"
       x-transition:enter-start="opacity-0 transform"
       x-transition:enter-end="opacity-100 transform"
       x-transition:leave="transition origin-left duration-100"
       x-transition:leave-start="opacity-100 transform"
       x-transition:leave-end="opacity-0 transform"
       @click.away="sidebarOpen = ! sidebarOpen">
    <div class="sticky-top-0 flex h-full w-full flex-shrink-0 flex-col justify-between overflow-y-auto py-6 px-4 transition duration-200 sm:w-auto" id="vertical-navbar">
      <div class="flex flex-col space-y-1">
        <div class="flex items-center justify-between">
          <h1 class="mt-2 text-center text-lg font-bold uppercase tracking-wide text-indigo-500">WISMA LANSIA<br>HARAPAN ASRI</h1>
          <a href="#" @click="sidebarOpen = ! sidebarOpen"
             class="mt-2 ml-2 mb-auto h-12 w-12 items-center space-x-4 rounded-md bg-red-400 text-lg font-semibold text-white transition duration-200 hover:bg-red-600 hover:text-indigo-600" :class="sidebarOpen ? 'flex' : 'hidden'">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list m-auto h-6 w-6 text-white" viewBox="0 0 16 16" :class="sidebarOpen ? 'hidden' : ''">
              <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill m-auto text-white" viewBox="0 0 16 16" :class="sidebarOpen ? '' : 'hidden'">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
            </svg>
          </a>
        </div>
        <div class="border-b-2 pb-4 text-lg font-semibold">Sebagai {{ ucwords(session()->get('auth_wlha.username.0')) }}</div>
        {{-- Use icon from here
            https://heroicons.com/ choose from the outline one --}}
        <div>
          @include('layouts.navigationlist')
        </div>
      </div>
      {{-- LOGOUT --}}
      <div class="mt-auto flex flex-col space-y-4">
        <a href="{{ route('auth.logout') }}"
           class="mt-1 flex items-center space-x-4 p-2 text-lg font-semibold text-red-400 transition duration-200 hover:text-red-600">
          <svg class="mr-4 h-6 w-6 text-red-400 transition duration-200 hover:text-red-600" fill="none"
               stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
            </path>
          </svg>
          Keluar
        </a>
      </div>
    </div>
</template>
<!-- END: Side Navbar -->
<div class="mb-96 flex h-full">
  <div class="h-full overflow-y-auto bg-indigo-50" :class="sidebarOpen ? 'w-full' : 'w-full'" id='content'>
    <div class="z-40">
      {{ $slot }}
    </div>
    <div class="m-4"></div>
  </div>

  <script>
    var expanded = false;
    $('#expand').on('click', function() {
      // hidden md:flex flex-col justify-between w-72 py-6 px-4 static
      if (expanded) {
        expanded = false;
        $('#vertical-navbar').removeClass('flex');
        $('#vertical-navbar').addClass('hidden');
        $('#vertical-navbar').addClass('md:flex');
        $('#content').removeClass('hidden');
        $('#content').addClass('flex-auto');
        $('#expand').html('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list w-6 h-6 mx-2 text-white" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" /></svg>')
      } else {
        expanded = true;
        $('#vertical-navbar').removeClass('hidden');
        $('#vertical-navbar').addClass('flex');
        $('#vertical-navbar').addClass('md:flex');
        $('#content').removeClass('flex-auto');
        $('#content').addClass('hidden');
        $('#expand').html('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill w-6 h-6 mx-2 text-white" viewBox="0 0 16 16"> <path d = "M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" / ></svg>')
      }
    })
  </script>
</div>
