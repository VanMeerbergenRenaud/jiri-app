{{-- Modal to trash an event --}}
<template x-if="showModal">
    <div class="modal" @click="showModal = false">
        <div class="modal__dialog" @click.stop="showModal = true">
            <p class="modal__title">
                {{ $title }}
            </p>
            <div class="modal__buttons">
                <button class="cancel-button" @click="showModal = false">
                    Annuler
                </button>
                <form action="{{ $action }}"
                      method="POST">
                    @csrf
                    @method('{{ $method }}')
                    <button type="submit" class="confirm-button" @click.stop="showModal = true">
                        Confirmer la suppression
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
