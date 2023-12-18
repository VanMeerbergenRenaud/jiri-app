<div class="notifications">
    <div class="notifications__container">
        <div class="notification">
            <div class="icon">
                @if($icon === 'delete')
                    <x-svg.trash2 />
                @elseif($icon === 'success')
                    <x-svg.success />
                @elseif($icon === 'edit')
                    <x-svg.edit />
                @elseif($icon === 'add')
                    <x-svg.add />
                @elseif($icon === 'advertising')
                    <x-svg.advertising />
                @else
                    <x-svg.show />
                @endif
            </div>
            <div class="text">
                <p class="text-sm font-medium text-gray-900">
                    {{ $title }}
                </p>
                <p class="mt-1 text-sm text-gray-500">
                    {{ $message }}
                </p>
            </div>
            <div class="cross">
                <button type="button" wire:click="{{ $method }}">
                    <x-svg.cross />
                </button>
            </div>
        </div>
    </div>
</div>
