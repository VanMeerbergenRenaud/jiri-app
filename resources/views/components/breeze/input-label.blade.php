@props(['value'])

<label {{ $attributes->class(['class' => '']) }}>
    {{ $value ?? $slot }}
</label>
