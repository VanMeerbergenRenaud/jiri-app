<!-- Component to controls form fields -->
@props(['label', 'name', 'placeholder', 'model' => '', 'attributes' => [], 'messages', 'value' => ''])

<div class="form__field">
    <label for="{{ $name }}">
        {{ ucfirst($label) }}
    </label>

    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        cols="12"
        rows="5"
        placeholder="{{ $placeholder }}"
        value="{{ old($name) ?? $value}}"
        wire:model="{{ $model }}"
        {{ $attributes }}
    ></textarea>

    @if ($messages)
        <ul class="error-message">
            @foreach ((array) $messages as $message)
                <li class="error-message__item">{{ $message }}</li>
            @endforeach
        </ul>
    @endif
</div>
