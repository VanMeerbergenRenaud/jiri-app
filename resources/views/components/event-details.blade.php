<li class="item">
    <h3 class="item__name">{{ $event->name }}</h3>
    <div class="item__date">
        Date de l’épreuve<br>
        <time datetime="{{$event->starting_at}}">
            {{ \Carbon\Carbon::parse($event->starting_at)->format('j F Y \à G\hi')}}
        </time>
    </div>
    <div class="item__time">
        Durée de l’épreuve<br>
        <time datetime="{{$event->duration}}">
            @php
                $duration = $event->duration;
                $hours = floor($duration / 60);
                $minutes = $duration % 60;
            @endphp
            {{$hours}}h{{$minutes}}min
        </time>
    </div>
    <div class="item__members">
        Participants<br>
        <p>
            <span>12 évaluateurs</span> &nbsp;|&nbsp;
            <span>24 évalués</span>
        </p>
    </div>
    {{-- Liens : Édition, Voir, Non disponible, Éditer, Supprimer --}}
    <div class="link" x-data="{ showModal: false }">
        <a href="{{ route('events.show', ['event' => $event]) }}" class="link__edition">Édition des profils et infos</a>

        @if(now() >= $event->starting_at)
            <a href="{{ route('events.show', ['event' => $event]) }}" class="link__see">Voir</a>
        @else
            <button class="link__unavailable">Non disponible</button>
        @endif

        <a href="{{ route('events.edit', ['event' => $event]) }}" class="link__edit">@include('components.svg.edit')</a>

        <button @click="showModal = !showModal" class="link__delete">@include('components.svg.trash')</button>

        {{-- Modal to trash an event --}}
        <div x-show="showModal" class="modal">
            <div class="modal__dialog" @click.away="showModal = false">
                <p class="modal__title">
                    Êtes-vous sûr de vouloir supprimer l'événement&nbsp;?
                </p>
                <div class="modal__buttons">
                    <button class="cancel-button" @click="showModal = false">
                        Annuler
                    </button>
                    <form action="{{ route('events.destroy', ['event' => $event]) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="confirm-button" @click="showModal = false">
                            Confirmer la suppression
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</li>
