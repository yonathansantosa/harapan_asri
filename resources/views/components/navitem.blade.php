@props(['viewbox' => '0 0 24 24', 'active' => false, 'svgd' => 'M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z'])

<a {{ $attributes }} class="@if ($active) {{ 'bg-indigo-600 text-white border-indigo-600' }}
        @else
            {{ 'bg-white border-white text-gray-600 hover:text-indigo-600 hover:border-indigo-600' }} @endif mt-1 flex items-center space-x-4 rounded-md border-2 p-2 text-lg font-semibold transition duration-200">
  <svg class="mr-4 h-6 w-6"
    fill="none"
    stroke="currentColor" viewBox=$viewbox xmlns="http://www.w3.org/2000/svg">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="{{ $svgd }}">
    </path>
  </svg>
  {{ $slot }}
</a>
