@props(['viewbox' => '0 0 24 24', 'active' => false, 'svgd' => ''])
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
