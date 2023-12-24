<x-app-layout>
    <main class="mainProfil">
        <div class="mainProfil__intro">
            <h2>Profil du contact
            </h2>
            <p>Découvrez toutes les informations de {{ $contact->name }}.</p>
        </div>

        <div class="mainProfil__nav">
            <a href="{{ url()->previous() }}" class="button--gray">
                @include('components.svg.arrow-left')
                Retour
            </a>
            <label for="students">
                <select id="students">
                    <option value="" selected disabled>Sélectionnez un autre étudiant !</option>
                    <option value="1">Etudiant 1</option>
                    <option value="2">Etudiant 2</option>
                </select>
            </label>
        </div>

        {{--Liste des events (attendances) liés aux contacts --}}
        <div>
            Listes des épreuves dans lesquelles le contact apparait :

            <ul class="mb-8 mt-2">
                @foreach ($contact->attendances->unique('event_id') as $attendance)
                    <li class="p-4">
                        <p>
                            Épreuve :
                            <a href="{{ route('events.show', $attendance->event) }}">
                                {{ $attendance->event->name }}
                            </a>
                        </p>

                        <p>
                            Role : {{ $attendance->role }}
                        </p>

                        <p>
                            Profil et résultats :
                            {{-- TODO : direction vers le profil lié à une épreuve --}}
                            <a href="{{ route('events.showContact', ['event' => $attendance->event, 'contact' => $contact]) }}">
                                voir le profil
                            </a>
                        </p>

                        @if($attendance->role == 'evaluator')
                            <a class="underline p-2 font-bold"
                               href="{{ route('events.showEvaluator', [
                                    'event' => $attendance->event->id,
                                    'evaluator' => $attendance->contact->id,
                                    'token' => $attendance->token
                                ]) }}"
                            >
                                Accéder au dashboard de l'évaluateur
                            </a>
                        @endif
                    </li>
            @endforeach
        </div>
    </main>
</x-app-layout>
