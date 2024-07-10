<!-- Component to controls form fields -->
@props(['label', 'name', 'type', 'placeholder', 'model' => '', 'attributes' => [], 'messages', 'value' => '', 'srOnly' => false])

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
        wire:model.blur="{{ $model }}"
        {{ $attributes }}
    >

    @error ($model)
        <ul class="error-message">
            @foreach ($errors->get($model) as $message)
                <li class="error-message__item">{{ $message }}</li>
            @endforeach
        </ul>
    @enderror
</div>
