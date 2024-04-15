<div>
    @section('title')
        <h1 role="heading" aria-level="1" class="sr-only">Information du contact {{ $contact->name }}</h1>
    @endsection

    <main class="mainProfil mainProfilShowContact max-width">
        <div class="mainProfil__intro">
            <h2>Profil du contact</h2>
            <p>
                Listes des épreuves dans lesquelles
                <span class="font-semibold">{{ $contact->name }}</span>
                est inscrit.
            </p>
        </div>

        <div class="mainProfil__nav">
            <a href="{{ url()->previous() }}" class="button--gray">
                @include('components.svg.arrow-left')
                Retour
            </a>
            <label>
                <select>
                    <option value="" selected disabled>-- Sélectionnez un autre profil ---</option>
                    <option value="1">Etudiant 1</option>
                    <option value="2">Etudiant 2</option>
                </select>
            </label>
        </div>

        {{--Liste des events (attendances) liés aux contacts --}}
        <div class="contact__attendances">
            <ul class="contact__attendances__list">
                @forelse ($contact->attendances->unique('event_id') as $attendance)
                    <li>
                        <p>
                            <span>Épreuve&nbsp;:</span>
                            <a href="{{ route('events.show', $attendance->event) }}">
                                {{ $attendance->event->name }}
                            </a>
                        </p>

                        <p>
                            <span>Rôle&nbsp;:</span>

                            @php
                                $translations = [
                                    'evaluator' => 'évaluateur',
                                    'student' => 'étudiant',
                                ];
                            @endphp

                            <span class="capitalize">{{ $translations[$attendance->role] ?? 'Non défini' }}</span>
                        </p>

                        <p>
                            <span>Profil et résultats&nbsp;:</span>
                            <a href="{{ route('events.contact-profil', ['event' => $attendance->event, 'contact' => $contact]) }}">
                                Voir
                            </a>
                        </p>

                        @if($attendance->role == 'evaluator')
                            <a class="link"
                               href="{{ route('events.evaluator-dashboard', [
                                'event' => $attendance->event->id,
                                'contact' => $attendance->contact->id,
                                'token' => $attendance->token
                            ]) }}"
                            >
                                Dashboard de l'évaluateur
                            </a>
                        @endif
                    </li>
                @empty
                    <li>
                        <p>Aucune épreuve liée à ce contact.</p>
                    </li>
                @endforelse
            </ul>
        </div>
    </main>
</div>
