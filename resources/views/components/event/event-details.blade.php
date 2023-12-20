<li class="item">
    <h3 class="item__name">{{ $event->name }}</h3>
    <div class="item__date">
        Date de l’épreuve<br>
        <time datetime="{{$event->starting_at}}">
            {{ \Carbon\Carbon::parse($event->starting_at)->format('j M Y \à G\hi')}}
        </time>
    </div>
    <div class="item__time">
        Durée de l’épreuve<br>
        <time datetime="{{ $event->duration }}">
            @php
                $duration = $event->duration;
                $hours = floor($duration / 60);
                $minutes = $duration % 60;
            @endphp
            @if($hours > 0)
                {{$hours}}h{{$minutes}}min
            @else
                {{$minutes}}min
            @endif
        </time>
    </div>
    <div class="item__members">
        Participants<br>
        <p>
            @if($event->contacts->count() > 0)
                <span>{{ $event->contacts->count() }} enregistrés</span>
            @else
                <span>0 enregistré</span>
            @endif
        </p>
    </div>
    {{-- Liens : Édition, Voir, Non disponible, Éditer, Supprimer --}}
    <div class="link" x-data="{ showModal: false }">
        <a href="{{ route('events.editEdition', ['event' => $event]) }}" wire:navigate class="link__edition">
            Configurer l'épreuve
        </a>

        @if(now() >= $event->starting_at)
            <a href="{{ route('events.show', ['event' => $event]) }}" wire:navigate class="link__see">Voir</a>
        @else
            <button type="button" class="link__unavailable">Non disponible</button>
        @endif

        <a href="{{ route('events.edit', ['event' => $event]) }}" wire:navigate class="link__edit">@include('components.svg.edit')</a>

        <button @click="showModal = !showModal" class="link__delete">
            @include('components.svg.trash')
        </button>

        {{-- Modal to trash an event --}}
        <template x-if="showModal">
            <div class="modal" @click="showModal = false">
                <div class="modal__dialog" @click.stop="showModal = true">
                    <p class="modal__title">
                        Êtes-vous sûr de vouloir supprimer cette épreuve ?
                    </p>
                    <div class="modal__buttons">
                        <button class="cancel-button" @click="showModal = false">
                            Annuler
                        </button>
                        <form method="POST" action="{{ route('events.destroy', ['event' => $event]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="confirm-button" @click.stop="showModal = true">
                                Confirmer la suppression
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </div>
</li>
