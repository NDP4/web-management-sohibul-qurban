@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-700 bg-gray-800 text-gray-300 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm']) !!}>
    {{ $slot }}
</select>
