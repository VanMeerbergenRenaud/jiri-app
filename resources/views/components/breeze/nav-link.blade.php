@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav-link__active'
            : 'nav-link';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
