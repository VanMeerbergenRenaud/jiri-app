<!-- Component to controls inputs -->
<div>
    <!-- Label -->
    <label for="{{ $name }}">{{ $label }}</label>
    <!-- Input -->
    <input type="{{ $type }}" wire:model="{{ $model }}" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ $value ??  '' }}">
    <!-- Error -->
    <div>
        @error($model)
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
</div>
