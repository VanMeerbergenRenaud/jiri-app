<div
    wire:ignore
    x-data
    x-init="FilePond.create($refs.input);"
>
    <input type="file" x-ref="input">
</div>
