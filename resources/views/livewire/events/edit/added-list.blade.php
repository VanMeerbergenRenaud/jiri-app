{{-- AddedList of contacts --}}
<div class="form__component__added">
    <p>Contacts ajoutés</p>
    @if(count($attendanceList) > 0)
        <ul>
            @php
                $roleTranslations = [
                    'student' => 'étudiant',
                    'evaluator' => 'évaluateur',
                ];
             @endphp
            @foreach($attendanceList as $attendance)
                <li wire:key="{{ $attendance->id }}">
                    <span class="category capitalize">{{ $roleTranslations[$attendance->role] ?? 'Neutre' }}</span>
                    <span class="username capitalize">{{ $attendance->contact->name ?? 'Contact inconnu' }}</span>
                    <button type="button" wire:click="removeContact({{ $attendance->id }})" wire:confirm="Êtes-vous sûr de vouloir supprimer le contact '{{ $attendance->contact->name }}' de l'épreuve ?">
                        @include('components.svg.trash2')
                    </button>
                </li>
            @endforeach
        </ul>
    @else
        <p class="no-contact">Aucun contact ajouté pour le moment.</p>
    @endif
</div>
