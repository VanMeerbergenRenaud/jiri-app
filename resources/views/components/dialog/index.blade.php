<div
    x-data="{ dialogOpen: false }"
    x-modelable="dialogOpen"
    {{ $attributes }} {{-- Usefull when you want to add attributes to the dialog, like a wire:model,... --}}
    tabindex="-1"
>
    {{ $slot }}
</div>
