<select id="{{ $id }}" name="{{ $name }}" {{ $invalid ?? $attributes->merge(['class' => 'block mb-2 text-lg text-red-500 ']) }}>>
  <option value="" selected="selected">{{ $placeholder ?? '' }}</option>
  {{ $slot }}
</select>
