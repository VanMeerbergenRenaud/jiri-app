{{-- Contact view --}}
<x-app-layout>
    <main class="mainContacts">
        <div class="contacts__intro">
            <livewire:welcome-message
                    :title="'Bonjour ' . $user->name"
                    :message="'Découvrez la liste de tous vos contacts.'"
            />
            <a href="{{ route('events.create') }}" class="ml-8 button--classic">Créer un nouveau contact</a>
        </div>
        {{-- Liste des contacts --}}
        <div class="grid grid-cols-2 gap-8">
            <div class="col-span-1">
                <div x-data="{ search: '' }">
                    <h3 class="text-2xl font-bold mt-8 mb-4">Liste des étudiants</h3>
                    <label>
                        <input type="text" x-model="search" placeholder="Rechercher un étudiant..." class="w-full mb-6 p-2 border border-gray-400 rounded-lg">
                    </label>
                    <ul>
                        @if(count($students) > 0)
                            @foreach($students as $student)
                                <template x-if="search === '' || '{{ $student->name }}'.toLowerCase().includes(search.toLowerCase())">
                                    <li class="bg-gray-100 rounded-lg p-4 mb-4">
                                        <div class="font-bold">{{ $student->name }}</div>
                                        <div class="text-gray-600">{{ $student->email }}</div>
                                        <div class="text-gray-600">id : {{ $student->id }}</div>
                                        <div class="text-gray-600">user-id : {{ $student->user_id }}</div>
                                    </li>
                                </template>
                            @endforeach
                        @else
                            <p>Aucun étudiant à afficher pour le moment.</p>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-span-1">
                <div x-data="{ search: '' }">
                    <h3 class="text-2xl font-bold mt-8 mb-4">Liste des évaluateurs</h3>
                    <label>
                        <input type="text" x-model="search" placeholder="Rechercher un évaluateur..." class="w-full mb-4 p-2 border border-gray-400 rounded-lg">
                    </label>
                    <ul>
                        @if(count($evaluators) > 0)
                            @foreach($evaluators as $evaluator)
                                <template x-if="search === '' || '{{ $evaluator->name }}'.toLowerCase().includes(search.toLowerCase())">
                                    <li class="bg-gray-100 rounded-lg p-4 mb-4">
                                        <div class="font-bold">{{ $evaluator->name }}</div>
                                        <div class="text-gray-600">{{ $evaluator->email }}</div>
                                        <div class="text-gray-600">id : {{ $evaluator->id }}</div>
                                        <div class="text-gray-600">user-id : {{ $evaluator->user_id }}</div>
                                    </li>
                                </template>
                            @endforeach
                        @else
                            <p>Aucun membre du jury à afficher pour le moment.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
