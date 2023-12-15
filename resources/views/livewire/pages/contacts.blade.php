{{-- Contact view --}}
<x-app-layout>
    <main class="mainContacts">
        <div class="contacts__intro">
            <livewire:header
                :title="'Bonjour ' . $user->name"
                :message="'Découvrez la liste de tous vos contacts.'"
            />
            <a href="{{ route('contacts.create') }}" class="ml-8 button--classic">Créer un nouveau contact</a>
        </div>
        {{-- Liste des contacts --}}
        <div class="grid gap-8">
            <div x-data="{ search: '' }">
                <h3 class="text-2xl font-bold mt-8 mb-4">Liste des contacts</h3>
                <label>
                    <input type="text" x-model="search" placeholder="Rechercher un contact..." class="w-full mb-4 p-2 border border-gray-400 rounded-lg">
                </label>
                <ul>
                    @if(count($contacts) > 0)
                        @foreach($contacts as $contact)
                            <template x-if="search === '' || '{{ $contact->name }}'.toLowerCase().includes(search.toLowerCase())">
                                <li class="bg-gray-100 rounded-lg p-6 mb-4 flex gap-3 items-center relative">
                                    {{-- Image --}}
                                    <div class="w-16 h-16 rounded-full overflow-hidden">
                                        <img src="{{ $contact->profile_image }}" alt="{{ $contact->name }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="font-bold">{{ $contact->name }}</div>
                                    <div class="font-bold">{{ $contact->firstname }}</div>
                                    <div class="text-gray-600">{{ $contact->email }}</div>
                                    <div class="text-gray-600">id : {{ $contact->id }}</div>
                                    <div class="text-gray-600">user-id : {{ $contact->user_id }}</div>
                                    <div class="flex gap-3 absolute right-3">
                                        <a href="{{ route('contacts.edit', $contact) }}" class="button--classic">Modifier</a>
                                        <form action="{{ route('contacts.destroy', $contact) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button--classic">Supprimer</button>
                                        </form>
                                    </div>
                                </li>
                            </template>
                        @endforeach
                    @else
                        <p>Aucun contact à afficher pour le moment.</p>
                    @endif
                </ul>
            </div>
        </div>
    </main>
</x-app-layout>
