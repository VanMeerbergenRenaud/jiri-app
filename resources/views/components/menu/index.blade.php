<div x-data="{ menuOpen: false }">
    <div x-menu x-model="menuOpen" class="menu">
        {{ $slot }}
    </div>
</div>
