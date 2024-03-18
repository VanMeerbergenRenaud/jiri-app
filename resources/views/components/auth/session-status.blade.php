@props(['status'])

@if ($status)
    <div {{ $attributes->class(['class' => 'status']) }}>
        {{ $status }}
    </div>
@endif
