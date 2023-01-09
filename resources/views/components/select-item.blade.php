@props(['invalid' => false])
@php
  $class = '';
  if ($invalid == 'true') {
      $class .= 'text-red-500';
  }
@endphp
<option {{ $attributes->merge(['class' => $class]) }}>
  {{ $slot }}
</option>
