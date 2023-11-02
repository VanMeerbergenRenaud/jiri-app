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
            @unless(empty($jiris))

            <ul class="list">
                Liste des épreuves en cours
                @foreach($jiris as $jiri)
                <li class="item">
                    <h3 class="item__name">{{ $jiri->name }}</h3>
                    <div class="item__date">
                        Date de l’épreuve<br>
                        <time datetime="{{$jiri->starting_at}}">
                            {{ \Carbon\Carbon::parse($jiri->starting_at)->format('j F Y \à G\hi')}}
                        </time>
                    </div>
                    <div class="item__time">
                        Durée de l’épreuve<br>
                        <time datetime="{{$jiri->duration}}">
                            @php
                                $duration = $jiri->duration;
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
                    <a href="{{ route('events.edit') }}" class="item__edition">Édition des profils et infos</a>
                    <a href="{{ route('events.show') }}" class="item__see">Voir</a>
                    {{--<a href="#" class="item__unavailable">Non disponible</a>--}}
                </li>
                @endforeach
            </ul>
            @endunless

            {{--<div class="flex-center empty">
                <p>Aucune épreuve n’a encore été créé jusqu’à présent.</p>
                <a href="{{ route('events.create') }}" class="underline-blue">Créer une première épreuve</a>
            </div>--}}
        </div>
    </main>
</x-app-layout>
