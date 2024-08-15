<div class="form__ponderation">
    <div class="contact__ponderation">
        <h3 role="heading" aria-level="3" class="contact__ponderation__title">
            Ajouter une pondération
        </h3>
        <p class="contact__ponderation__text">
            La pondération est un pourcentage qui représente l'importance relative de chaque projet dans un évènement. Vous pouvez ajouter un ou plusieurs projets pour l'évènement, mais il est important de répartir équitablement le pourcentage de pondération entre eux.
            Chaque épreuve doit avoir une pondération totale de 100%. Par conséquent, la somme des pondérations de tous les projets doit être égale à 100%.
            Il est important de noter qu'il y a deux pondérations possibles pour chaque épreuve. Si un étudiant ne réussit pas une épreuve, la deuxième pondération peut être utilisée pour améliorer sa note globale.
        </p>

        @if($ponderationOfProjects->isEmpty())
            <p class="contact__ponderation__empty">
                Aucun projet n'a encore été ajouté à l'évènement.
            </p>
        @else
            <form wire:submit.prevent="save">
                @csrf

                <div class="contact__ponderation__lists">
                    <ul class="contact__ponderation__lists__list">
                        Pondération 1
                        @foreach($ponderationOfProjects as $project)
                            <li>
                                <x-form.field
                                    label="{{ ucfirst($project->project->name) }}"
                                    name="ponderations.{{ $project->project->id }}.ponderation1"
                                    type="number"
                                    min="1"
                                    max="100"
                                    placeholder="1 à 100"
                                    value="{{ $project->ponderation1 }}"
                                    required
                                    model="ponderations.{{ $project->project->id }}.ponderation1"
                                />
                            </li>
                        @endforeach
                        @if($errors->has('ponderation1'))
                            <div class="error-percentage">
                                <ul>
                                    @foreach ($errors->get('ponderation1') as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </ul>
                    <ul class="contact__ponderation__lists__list">
                        Pondération 2
                        @foreach($ponderationOfProjects as $project)
                            <li>
                                <x-form.field
                                    label="{{ ucfirst($project->project->name) }}"
                                    name="ponderations.{{ $project->project->id }}.ponderation2"
                                    type="number"
                                    min="1"
                                    max="100"
                                    placeholder="1 à 100"
                                    value="{{ $project->ponderation2 }}"
                                    required
                                    model="ponderations.{{ $project->project->id }}.ponderation2"
                                />
                            </li>
                        @endforeach
                        @if($errors->has('ponderation2'))
                            <div class="error-percentage">
                                <ul>
                                    @foreach ($errors->get('ponderation2') as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </ul>

                    @if($errors->has('ponderations'))
                        <div class="error-percentage">
                            <ul>
                                @foreach ($errors->get('ponderations') as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="button" class="adjustPonderation" wire:click="save">
                        Ajuster la pondération
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>
