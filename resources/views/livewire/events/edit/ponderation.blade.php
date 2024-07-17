<div>
    <form class="contact__ponderation" wire:submit.prevent="save">
        @csrf

        <h3 role="heading" aria-level="3" class="contact__ponderation__title">Pondération</h3>
        <p class="contact__ponderation__text">
            La pondération reprend chaque projet ajouté à l'évènement et permet de décider quel pourcentage sur 100 le projet aura, donc il faut listé les projets sélectionné et ensuite chaque projet à un input correspond qui permet de choisir le pourcentage sur 100, attention si j'ai par exemple 2 projets, la valeur en pourcentage totale des 2 réunis ne doit pas dépasser 100%.
        </p>

        @if($ponderationOfProjects->isEmpty())
            <p class="contact__ponderation__empty">
                Aucun projet n'a encore été ajouté à l'évènement.
            </p>
        @else
            <div class="contact__ponderation__lists">
                <ul class="contact__ponderation__lists__list">
                    Pondération 1
                    @foreach($ponderationOfProjects as $project)
                        <li class="form__field">
                            <x-form.field
                                label="Projet: {{ $project->project->name }}"
                                name="ponderations.{{ $project->project->id }}.ponderation1"
                                type="number"
                                min="1"
                                max="100"
                                placeholder="Ex : 24"
                                value="{{ $project->ponderation1 }}"
                                model="ponderations.{{ $project->project->id }}.ponderation1"
                            />
                        </li>
                    @endforeach
                </ul>
                <ul class="contact__ponderation__lists__list">
                    Pondération 2
                    @foreach($ponderationOfProjects as $project)
                        <li class="form__field">
                            <x-form.field
                                label="Projet: {{ $project->project->name }}"
                                name="ponderations.{{ $project->project->id }}.ponderation2"
                                type="number"
                                min="1"
                                max="100"
                                placeholder="Ex : 24"
                                value="{{ $project->ponderation2 }}"
                                model="ponderations.{{ $project->project->id }}.ponderation2"
                            />
                            {{--remaining percentage--}}
                            @php
                                $basicRemainingPercentage = 100 - $project->ponderation1;
                                $remainingPercentage = 100 - ($project->ponderation1 + $project->ponderation2);
                            @endphp
                            <span class="contact__ponderation__lists__list__remaining">
                                Il vous faut {{ $basicRemainingPercentage }}% pour atteindre 100% pour le projet {{ $project->project->name }} et il
                                reste {{ $remainingPercentage }}% à répartir.
                            </span>
                        </li>
                    @endforeach
                </ul>

                {{-- Projets qui ne sont pas à 100% de pondérations :  --}}

            </div>
        @endif

        <button type="button" class="button--white" wire:click="save">Ajuster la pondération</button>
    </form>
</div>
