<x-app-layout>
    <main class="mainEvents">
        <div class="events__intro">
            <livewire:welcome-message
                :title="'Bonjour ' . $user->name"
                :message="'Découvrez la liste des diverses épreuves à venir ou déjà passées.'"
            />
            <a href="{{ route('events.create') }}" class="button--classic">Créer une nouvelle épreuve</a>
        </div>
        {{-- Events --}}
        <div class="events">
            @unless(empty($events))
            <ul class="list">
                Liste des épreuves en cours
                @foreach($events as $event)
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
                    <a href="{{ route('events.show', ['event' => $event]) }}" class="item__edition">Édition des profils et infos</a>
                    <a href="{{ route('events.show', ['event' => $event]) }}" class="item__see">Voir</a>
                    {{--<a href="#" class="item__unavailable">Non disponible</a>--}}

                    {{-- Editer l'épreuve --}}
                    <a href="{{ route('events.edit', ['event' => $event]) }}" class="item__edition" style="background-color: whitesmoke">Editer</a>
                </li>

                @endforeach
            </ul>
                @else
                <div class="flex-center empty">
                    <p>Aucune épreuve n’a encore été créé jusqu’à présent.</p>
                    <a href="{{ route('events.create') }}" class="underline-blue">Créer une première épreuve</a>
                </div>
            @endunless
        </div>
    </main>
</x-app-layout>
