<div class="notifications">
    <div
        class="notifications__container"
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 3000)"
        x-transition:enter="transition ease-out duration-300"
    >
        <div class="notification">
            <div class="icon">
                @if($icon === 'delete')
                    <x-svg.trash2 />
                @elseif($icon === 'success')
                    <x-svg.success />
                @elseif($icon === 'import')
                    <x-svg.import />
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
            <div class="cross" @click="show = false">
                <button type="button" wire:click="{{ $method }}">
                    <x-svg.cross />
                </button>
            </div>
        </div>
    </div>
</div>
