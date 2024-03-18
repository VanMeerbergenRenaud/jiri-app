<!-- Component to controls form fields -->
@props(['label', 'name', 'type', 'placeholder', 'model' => '', 'attributes' => [], 'messages'])

<div class="form__field">
    <label for="{{ $name }}">
        {{ ucfirst($label) }}
    </label>

    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($name) ?? '' }}"
        wire:model="{{ $model }}"
        {{ $attributes }}
    >

    @if ($messages)
        <ul class="error-message">
            @foreach ((array) $messages as $message)
                <li class="error-message__item">{{ $message }}</li>
            @endforeach
        </ul>
    @endif
</div>
