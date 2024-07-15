<div>
    <!-- Header -->
    <div class="header">
        <x-banner
            :title="'Bonjour ' . ($contact->name ?? 'cher évaluateur') . ' 👋🏻.'"
            :message="'Choisissez un épreuve que vous devez évaluer.'"
        />
    </div>

    <!-- Main content -->
    <main class="mainEvaluatorDashboard">
        <ul>
            @foreach($events as $event)
                <li>
                    <a href="{{ route('events.evaluator-dashboard-event', [
                            'event' => $event->event,
                            'contact' => $contact->id,
                            'token' => $event->token
                        ]) }}" wire:navigate
                    >
                        {{ $event->id }} - {{ $event->event->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </main>
</div>
