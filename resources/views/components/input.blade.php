@props(['disabled' => false, 'invalid' => false, 'mb' => true])

@php
  $class = 'text-lg w-full px-3 py-4 border rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300';
  if ($mb) {
      $class .= ' mb-4';
  }
  if ($invalid == 'true') {
      $class .= ' placeholder-red-400 border-red-300 text-red-500';
  } elseif ($invalid == 'success') {
      $class .= ' placeholder-green-400 border-green-300 text-green-500';
  } else {
      $class .= ' mr-2 placeholder-gray-400 border-gray-300';
  }
@endphp

<input {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => $class]) }} />
