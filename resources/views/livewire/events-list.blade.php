<x-app-layout>
    <main class="mainEvents">
        <div class="events__intro">
            <livewire:welcome-message
                :title="'Bonjour ' . $user->name"
                :message="'Découvrez la liste des diverses épreuves à venir ou déjà passées.'"
            />
            <a href="{{ route('events.create') }}" class="ml-8 button--classic">Créer une nouvelle épreuve</a>
        </div>
        {{-- Events --}}
        <div class="events" x-data="{ showModal: false }">
            @if (count($events) === 0)
                Liste des épreuves
                <div class="flex-center empty">
                    <p>Aucune épreuve n’a encore été créée jusqu’à présent.</p>
                    <a href="{{ route('events.create') }}" class="underline-blue">Créer une première épreuve</a>
                </div>
            @else
                <!-- Liste des épreuves passées -->
                <ul class="list">Liste des épreuves passées
                    @foreach($events->where('starting_at', '<', now()) as $event)
                        @include('components.event-details', ['event' => $event])
                    @endforeach
                </ul>

                <!-- Liste des épreuves en cours -->
                <ul class="list">Liste des épreuves en cours
                    @foreach($events->where('starting_at', '>', now())->where('starting_at', '<', now()->addHour()) as $event)
                        @include('components.event-details', ['event' => $event])
                    @endforeach
                </ul>

                <!-- Liste des épreuves à venir -->
                <ul class="list">Liste des épreuves à venir
                    @foreach($events->where('starting_at', '>', now()->addHour()) as $event)
                        @include('components.event-details', ['event' => $event])
                    @endforeach
                @endif
            </ul>
        </div>
    </main>
</x-app-layout>
