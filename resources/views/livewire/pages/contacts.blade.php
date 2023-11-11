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
        <div class="contacts__list">
            <h3>Liste des utilisateurs</h3>
            <div class="events__users__list">
                <div class="events__users__list__student">
                    <h4 class="text-2xl font-bold my-6">Étudiants</h4>
                    <ul>
                        @if(count($students) > 0)
                            @foreach($students as $student)
                                <li class="bg-gray-100 rounded-lg p-4 mb-4">
                                    <div class="font-bold">{{ $student->name }}</div>
                                    <div class="text-gray-600">{{ $student->email }}</div>
                                    <div class="text-gray-600">id : {{ $student->id }}</div>
                                    <div class="text-gray-600">user-id : {{ $student->user_id }}</div>
                                </li>
                            @endforeach
                        @else
                            <p>Aucun étudiant à afficher pour le moment.</p>
                        @endif
                    </ul>
                </div>
                <div class="events__users__list__evaluator">
                    <h4 class="text-2xl font-bold my-6">Évaluateurs</h4>
                    <ul>
                    @if(count($evaluators) > 0)
                            @foreach($evaluators as $evaluator)
                                <li class="bg-gray-100 rounded-lg p-4 mb-4">
                                    <div class="font-bold">{{ $evaluator->name }}</div>
                                    <div class="text-gray-600">{{ $evaluator->email }}</div>
                                    <div class="text-gray-600">id : {{ $evaluator->id }}</div>
                                    <div class="text-gray-600">user-id : {{ $evaluator->user_id }}</div>
                                </li>
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
