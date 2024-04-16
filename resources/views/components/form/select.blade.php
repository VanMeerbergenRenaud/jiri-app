<!-- Component to controls select fields -->
@props(['label', 'name', 'type', 'placeholder', 'model' => '', 'attributes' => [], 'messages', 'value' => '', 'srOnly' => false, 'options' => []])

<div class="form__field">
    <label for="{{ $name }}" {{ $srOnly ? 'class=sr-only' : '' }}>
        {{ ucfirst($label) }}
    </label>

    <select
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes }}
    >
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $option)
            <option value="{{ $option->id }}" {{ old($name) == $option->id ? 'selected' : '' }}>
                {{ $option->name }}
            </option>
        @endforeach
    </select>

    @if ($messages)
        <ul class="error-message">
            @foreach ((array) $messages as $message)
                <li class="error-message__item">{{ $message }}</li>
            @endforeach
        </ul>
    @endif
</div>
