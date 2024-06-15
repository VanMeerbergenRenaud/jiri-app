<!-- Component to controls form fields -->
@props(['label', 'name', 'placeholder', 'model' => '', 'attributes' => [], 'messages', 'value' => ''])

<div class="form__field">
    <label for="{{ $name }}">
        {{ ucfirst($label) }}
    </label>

    <select
        id="{{ $name }}"
        name="{{ $name }}"
        wire:model="{{ $model }}"
        {{ $attributes }}
    >
        <option value="" selected disabled>{{ $placeholder }}</option>
        @foreach ($value as $option)
            <option value="{{ $option->id }}">{{ $option->name }}</option>
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
