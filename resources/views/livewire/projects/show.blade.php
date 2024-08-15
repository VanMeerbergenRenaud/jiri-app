<div>
    @section('title')
        <h1 role="heading" aria-level="1" class="sr-only">Information du projet {{ $project->name }}</h1>
    @endsection

    <main class="mainProfil mainProfilShowContact max-width">
        <div class="mainProfil__intro">
            <h2 role="heading" aria-level="2">Information du projet</h2>
            <p>
                Listes des évènements dans lesquelles le projet
                <span class="font-semibold">{{ ucfirst($project->name) }}</span>
                est inscrit.
            </p>
        </div>

        <div class="mainProfil__nav">
            <a href="{{ url()->previous() }}" class="button--gray" title="Retour à la page précédente">
                @include('components.svg.arrow-left')
                Retour
            </a>

            <x-form.select
                label="Nom d'un autre projet"
                name="name"
                placeholder="Sélectionner un autre projet -"
                :options="$projects"
                srOnly="true"
                wire:change="redirectUser($event.target.value)"
            />
        </div>

        {{--Liste des épreuves liées au projet--}}
        <div class="contact__eventContacts">
            <ul class="contact__eventContacts__list">
                @forelse($project->events as $event)
                    <li class="contact__eventContacts__list__item">
                        <p>
                            <span>Épreuve&nbsp;:</span>
                            <a href="{{ route('events.show', $event) }}" title="Vers la page de l'épreuve">
                                {{ $event->name }}
                            </a>
                        </p>
                    </li>
                @empty
                    <li>
                        <p>Aucune épreuve liée à ce projet.</p>
                    </li>
                @endforelse
            </ul>
        </div>
    </main>
</div>
