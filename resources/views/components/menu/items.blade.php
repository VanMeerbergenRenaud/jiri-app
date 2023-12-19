<div
    class="menu__items"
    x-cloak
    x-menu:items
    x-transition:enter.origin.top.right
    x-anchor.bottom-start="document.getElementById($id('alpine-menu-button'))"
>
    {{ $slot }}
</div>
