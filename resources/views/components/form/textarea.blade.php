<!-- Component to controls form fields -->
@props(['label', 'name', 'placeholder', 'model' => '', 'attributes' => [], 'messages', 'value' => '', 'srOnly' => false])

<div class="form__field">
    <label for="{{ $name }}" {{ $srOnly ? 'class=sr-only' : '' }}>
        {{ ucfirst($label) }}
    </label>

    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        cols="12"
        rows="5"
        placeholder="{{ $placeholder }}"
        value="{{ old($name) ?? $value}}"
        wire:model.blur="{{ $model }}"
        {{ $attributes }}
    ></textarea>

    @error ($model)
        <ul class="error-message">
            @foreach ($errors->get($model) as $message)
                <li class="error-message__item">{{ $message }}</li>
            @endforeach
        </ul>
    @enderror
</div>
