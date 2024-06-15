{{-- AddedList of contacts --}}
<div class="form__component__added">
    <p>Contacts ajoutés</p>
    @if(count($eventContactsList) > 0)
        <ul>
            @php
                $roleTranslations = [
                    'student' => 'étudiant',
                    'evaluator' => 'évaluateur',
                ];
             @endphp
            @foreach($eventContactsList as $eventContacts)
                <li wire:key="{{ $eventContacts->id }}">
                    <span class="category capitalize">{{ $roleTranslations[$eventContacts->role] ?? 'Neutre' }}</span>
                    <span class="username capitalize">{{ $eventContacts->contact->name ?? 'Contact inconnu' }}</span>
                    <button class="button--white" type="button" wire:click="removeContact({{ $eventContacts->id }})" wire:confirm="Êtes-vous sûr de vouloir supprimer le contact '{{ $eventContacts->contact->name }}' de l'épreuve ?">
                        @include('components.svg.trash2')
                    </button>
                </li>
            @endforeach
        </ul>
    @else
        <p class="no-contact">Aucun contact ajouté pour le moment.</p>
    @endif
</div>
