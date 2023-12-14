{{-- Component to controls inputs --}}
<div>
    {{-- Label --}}
    <label for="{{ $name }}">{{ $label }}</label>
    {{-- Input --}}
    <input type="{{ $type }}" class="form-control" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ $value ??  '' }}">
    {{-- Errors --}}
    @error($name)
        <p class="error-message">{{ $message }}</p>
    @enderror
</div>
