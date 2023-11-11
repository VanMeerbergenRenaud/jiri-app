{{-- Contact container --}}
<div class="form__component">
    <h4>Ajouter des contacts</h4>
    <p>Vous pourrez en ajouter encore par la suite sans problème.</p>

    {{-- Dropdown & list of added contacts --}}
    <div
        class="custom__dropdown"
        x-data="{ open: false }"
        x-init="$watch('open', value => {
            if (value) {
                setTimeout(() => {
                    document.getElementById('contactSearch').focus();
                }, 0);
            }
        });"
    >
        {{-- Open button --}}
        <button @click="open = true" type="button" class="open-button">
            Sélectionner un contact
            @include('components.svg.arrow-down')
        </button>

        {{-- Dropdown panel --}}
        <div x-show="open" x-data="{createmode: false}" class="panel">

            {{-- Close button --}}
            <button x-show="open" @click="open = false" type="button" class="close-button">
                @include('components.svg.cross')
            </button>

            {{-- Search input + contact list --}}
            <livewire:contacts.contact-list :contacts="$contacts" />

            {{-- Form to create a new contact --}}
            <livewire:events.create.contact.form />

            {{-- Button to create a new contact --}}
            <button type="button"
                    class="add-button"
                    x-show="!createmode"
                    @click="createmode = true;"
            >
                Ajouter un nouveau contact
            </button>
        </div>

        {{-- AddedList contacts --}}
        <livewire:events.create.contact.added-list />
    </div>

</div>
