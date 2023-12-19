<x-app-layout>
    <main class="mainEvents">
        <div class="events__intro">
            <livewire:header
                :title="'Bonjour ' . $user->name"
                :message="'Découvrez la liste des diverses épreuves créées.'"
            />
            <a href="{{ route('events.create') }}" wire:navigate class="ml-8 button--classic">Créer une nouvelle épreuve</a>
        </div>
        {{-- Liste des épreuves --}}
        <div class="events">
            @if (count($events) === 0)
                Liste des épreuves
                <div class="flex-center empty">
                    <p>Aucune épreuve n’a encore été créée jusqu’à présent.</p>
                    <a href="{{ route('events.create') }}" wire:navigate class="underline-blue">Créer une première épreuve</a>
                </div>
            @else
                @if (!$pastEvents->isEmpty())
                    <ul class="list list1">
                        Liste des épreuves passées
                        @foreach($pastEvents as $event)
                            @include('components.event.event-details', ['event' => $event])
                        @endforeach
                    </ul>
                @endif

                @if (!$currentEvents->isEmpty())
                    <ul class="list list2">
                        Liste des épreuves en cours
                        @foreach($currentEvents as $event)
                            @include('components.event.event-details', ['event' => $event])
                        @endforeach
                    </ul>
                @endif

                @if (!$upcomingEvents->isEmpty())
                    <ul class="list list3">
                        Liste des épreuves à venir
                        @foreach($upcomingEvents as $event)
                            @include('components.event.event-details', ['event' => $event])
                        @endforeach
                    </ul>
                @endif
            @endif
        </div>
    </main>
</x-app-layout>
