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
                @foreach ($eventGroups as $status => $eventsGroup)
                    @if (!$eventsGroup->isEmpty())
                        <ul class="list @if($status === 'en cours') list2 @elseif($status === 'à venir') list3 @endif">
                            Liste des épreuves {{ $status }}
                            @foreach($eventsGroup as $event)
                                @include('components.event.event-details', ['event' => $event])
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            @endif
        </div>
    </main>
</x-app-layout>
