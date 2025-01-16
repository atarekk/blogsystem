@props(['disabled' => false, 'error' => null])

@php
    $classes = 'rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50';
    if ($error) {
        $classes .= ' border-red-300';
    }
@endphp

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $classes]) !!}>
@if($error)
    <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
@endif
