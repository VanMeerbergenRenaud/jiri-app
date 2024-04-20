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

            <x-form.select
                label="Nom d'un autre contact"
                name="name"
                placeholder="Sélectionner un autre profil -"
                :options="$contacts"
                :messages="$errors->get('name')"
                srOnly="true"
                wire:change="redirectUser($event.target.value)"
            />
        </div>

        {{--Liste des events (eventContacts) liés aux contacts --}}
        <div class="contact__eventContacts">
            <ul class="contact__eventContacts__list">
                @forelse ($contact->eventContacts->unique('event_id') as $eventContacts)
                    <li>
                        <p>
                            <span>Épreuve&nbsp;:</span>
                            <a href="{{ route('events.show', $eventContacts->event) }}">
                                {{ $eventContacts->event->name }}
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

                            <span class="capitalize">{{ $translations[$eventContacts->role] ?? 'Non défini' }}</span>
                        </p>

                        <p>
                            <span>Profil et résultats&nbsp;:</span>
                            <a href="{{ route('events.contact-profil', ['event' => $eventContacts->event, 'contact' => $contact]) }}">
                                Voir
                            </a>
                        </p>

                        @if($eventContacts->role == 'evaluator' && isset($eventContacts->token))
                            <a class="link"
                               href="{{ route('events.evaluator-dashboard', [
                                    'event' => $eventContacts->event->id,
                                    'contact' => $eventContacts->contact->id,
                                    'token' => $eventContacts->token
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
