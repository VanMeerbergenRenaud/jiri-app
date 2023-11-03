<x-app-layout>
    <main class="mainEvents">
        <div class="events__intro">
            <livewire:welcome-message
                :title="'Bonjour ' . $user->name"
                :message="'Découvrez la liste des diverses épreuves créées.'"
            />
            <a href="{{ route('events.create') }}" class="ml-8 button--classic">Créer une nouvelle épreuve</a>
        </div>
        {{-- Liste des épreuves --}}
        <div class="events">
            @if (count($events) === 0)
                Liste des épreuves
                <div class="flex-center empty">
                    <p>Aucune épreuve n’a encore été créée jusqu’à présent.</p>
                    <a href="{{ route('events.create') }}" class="underline-blue">Créer une première épreuve</a>
                </div>
            @else
                @php
                    $passedEvents = $events->where('starting_at', '<', now());
                    $ongoingEvents = $events->where('starting_at', '>', now())->where('starting_at', '<', now()->addHour());
                    $upcomingEvents = $events->where('starting_at', '>', now()->addHour());
                @endphp

                    <!-- Liste des épreuves passées -->
                @if (!$passedEvents->isEmpty())
                    <ul class="list">Liste des épreuves passées
                        @foreach($passedEvents as $event)
                            @include('components.event.event-details', ['event' => $event])
                        @endforeach
                    </ul>
                @endif

                <!-- Liste des épreuves en cours -->
                @if (!$ongoingEvents->isEmpty())
                    <ul class="list list2">Liste des épreuves en cours
                        @foreach($ongoingEvents as $event)
                            @include('components.event.event-details', ['event' => $event])
                        @endforeach
                    </ul>
                @endif

                <!-- Liste des épreuves à venir -->
                @if (!$upcomingEvents->isEmpty())
                    <ul class="list list3">Liste des épreuves à venir
                        @foreach($upcomingEvents as $event)
                            @include('components.event.event-details', ['event' => $event])
                        @endforeach
                    </ul>
                @endif
            @endif
        </div>
    </main>
</x-app-layout>
