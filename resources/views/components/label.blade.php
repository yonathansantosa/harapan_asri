@props(['value', 'invalid' => false, 'required' => false])

<label {{ $invalid != 'true' ? $attributes->merge(['class' => 'block mb-2 text-lg text-gray-800']) : $attributes->merge(['class' => 'block mb-2 text-lg text-red-500']) }}>
  {!! $value ?? $slot !!}{!! $required ? "<span class='text-red-500'>*</span>" : '' !!}
</label>
