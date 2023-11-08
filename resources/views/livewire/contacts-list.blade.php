<div class="contact-list" x-data="{
    createmode: true,
    contactname: ''
    }"
>
    <div class="p-4">
        <label for="contactname">Mes Contacts</label>
        <input type="text" id="contactname" wire:model.live="contactname" class="w-full mt-4 p-2 border rounded border-gray-300 focus:outline-none focus:border-blue-500">
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
            <p class="my-4">Aucun contact disponible.</p>
        @endunless
        {{--<button
                @click="createmode = true;
                contactname=$wire.get('contactname')"
                class="underline-blue"
        >
            Create
        </button>--}}
    </div>

    <template x-if="createmode">
        <form wire:submit="save" class="p-6 mb-6">
            <div class="mb-4">
                <label for="newcontactname">Nouveau nom de contact</label>
                <input type="text" id="newcontactname" x-model="contactname" wire:model="newcontactname">
                @error('newcontactname') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="newcontactemail">Nouveau email de contact</label>
                <input type="email" id="newcontactemail" wire:model="newcontactemail">
                @error('newcontactemail') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <button type="button" @click="$wire.set('newcontactname', contactname)" class="w-full bg-blue-500 text-white font-semibold py-2 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Enregistrer</button>
        </form>
    </template>
</div>
