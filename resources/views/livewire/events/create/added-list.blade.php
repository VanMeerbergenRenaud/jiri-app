{{-- AddedList of contacts --}}
<div class="form__component__added">
    <p>Contacts ajoutés</p>
    @if(count($attendanceList) > 0)
        <ul>
            @foreach($attendanceList as $attendance)
                <li wire:key="{{ $attendance->id }}">
                    <span class="category capitalize">{{ $attendance->role ?? 'Neutre' }}</span>
                    <span class="username capitalize">{{ $attendance->contact->name }}</span>
                    <button type="button" wire:click="removeContact({{ $attendance->id }})">
                        @include('components.svg.trash2')
                    </button>
                </li>
            @endforeach
        </ul>
    @else
        <p class="no-contact">Aucun contact ajouté pour le moment.</p>
    @endif
</div>
