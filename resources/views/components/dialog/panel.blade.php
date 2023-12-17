<template x-teleport="body">
    <div
        x-dialog
        x-model="dialogOpen"
        style="display: none"
        class="fixed inset-0 overflow-y-auto z-10 text-left pt-[30%] sm:pt-0"
    >
        <!-- Overlay -->
        <div x-dialog:overlay x-transition:enter.opacity class="fixed inset-0 bg-black/25"></div>

        <!-- Panel -->
        <div class="relative min-h-full flex justify-center items-end sm:items-center p-0 sm:p-4">
            <div
                x-dialog:panel
                x-transition.in
                class="dialog"
            >
                <!-- Close Button -->
                <div class="dialog__close-button">
                    <button type="button" @click="$dialog.close()">
                        <span class="sr-only">Fermer la modal</span>
                        <x-svg.cross />
                    </button>
                </div>

                <!-- Panel -->
                <div class="dialog__panel">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</template>
