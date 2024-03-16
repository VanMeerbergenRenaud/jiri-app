@props(['messages'])

@if ($messages)
    <ul {{ $attributes->class(['class' => '']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
