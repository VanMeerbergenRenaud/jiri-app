<!-- Component to controls form fields -->
@props(['label', 'name', 'type', 'placeholder', 'attributes' => [], 'messages', 'value' => '', 'srOnly' => false])

<div class="form__field">
    <label for="{{ $name }}" {{ $srOnly ? 'class=sr-only' : '' }}>
        {{ ucfirst($label) }}
    </label>

    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($name) ?? $value}}"
        {{ $attributes }}
    >

    @if ($messages)
        <ul class="error-message">
            @foreach ($messages as $message)
                <li class="error-message__item">{{ $message }}</li>
            @endforeach
        </ul>
    @endif
</div>
