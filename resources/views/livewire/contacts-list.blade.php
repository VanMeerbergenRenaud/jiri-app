<div class="contact-list" x-data="{
    createmode: false,
    contactname: '',
    }">
    <div class="container mx-auto p-4">
        <div class="py-4 text-center">
            <label for="contactname" class="text-2xl font-semibold">Mes Contacts</label>
            <input type="text" id="contactname" wire:model.live="contactname" class="w-full mt-4 p-2 border rounded border-gray-300 focus:outline-none focus:border-blue-500">
        </div>
        @unless($this->contacts->isEmpty())
            <ol class="mb-8">
                @foreach($this->contacts as $contact)
                    <li wire:key="{{ $contact->id }}" class="bg-white p-4 rounded shadow-md">
                        <label for="user{{$contact->id}}">{{ $contact->name }}</label>
                        <span for="user{{$contact->id}}">{{ $contact->email }}</span>
                        <input id="user{{$contact->id}}" type="checkbox">
                    </li>
                @endforeach
            </ol>
        @else
            <p class="text-center text-gray-500 mb-10">Aucun contact disponible.</p>
        @endunless
        <button x-on:click="createmode = true; contactname=$wire.get('contactname')">Create</button>
    </div>

    <template x-if="createmode" class="flex justify-center items-center">
        <form wire:submit="save" class="p-6 mx-auto rounded shadow-md w-full sm:w-80">
            <div class="mb-4">
                <label for="newcontactname" class="block text-lg font-semibold">Nouveau nom de contact</label>
                <input type="text" id="newcontactname" x-model="contactname" wire:model="newcontactname" class="w-full p-2 border rounded border-gray-300 focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="newcontactemail" class="block text-lg font-semibold">Nouveau email de contact</label>
                <input type="email" id="newcontactemail" wire:model="newcontactemail" class="w-full p-2 border rounded border-gray-300 focus:outline-none focus:border-blue-500">
            </div>
            <button type="submit" x-on:click="$wire.set('newcontactname', contactname)" class="w-full bg-blue-500 text-white font-semibold py-2 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Enregistrer</button>
        </form>
    </template>
</div>
