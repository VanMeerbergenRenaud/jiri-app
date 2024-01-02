<div>
    <label for="{{ $fieldId }}">
        @if($editId && $modelId === $editId)
            <input type="text" name="{{ $fieldName }}" id="{{ $fieldId }}" placeholder="{{ $placeholder }}" wire:model="{{ $modelName }}">
            @error($fieldName) <span class="error-message w-full underline text-center mb-2">{{ $message }}</span> @enderror
        @else
            <input type="text" name="{{ $fieldName }}" id="{{ $fieldId }}" placeholder="{{ $placeholder }}" value="{{ $fieldValue }}" disabled>
        @endif
    </label>
</div>
