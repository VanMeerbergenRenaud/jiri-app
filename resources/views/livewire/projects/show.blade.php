<div>
    @section('title')
        <h1 role="heading" aria-level="1" class="sr-only">Projets de l'administrateur</h1>
    @endsection

    <div class="projets__show">
        Le projet intervient dans ces évènements :
        <ul class="projects__show__list">
            @foreach($project->events as $event)
                <li class="projects__show__list__item">
                    <p>
                        <span>Épreuve&nbsp;:</span>
                        <a href="{{ route('events.show', $event) }}">
                            {{ $event->name }}
                        </a>
                    </p>
                </li>
            @endforeach
        </ul>
    </div>
</div>
