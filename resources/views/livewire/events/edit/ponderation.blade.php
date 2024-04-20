<div>
    <div class="contact__ponderation">
        <h3 role="heading" aria-level="3" class="contact__ponderation__title">Pondération</h3>
        <p class="contact__ponderation__text">
            La pondération reprend chaque projet ajouté à l'évènement et permet de décider quel pourcentage sur 100 le projet aura, donc il faut listé les projets sélectionné et ensuite chaque projet à un input correspond qui permet de choisir le pourcentage sur 100, attention si j'ai par exemple 2 projets, la valeur en pourcentage totale des 2 réunis ne doit pas dépasser 100%.
        </p>

        @if($projects->isEmpty())
            <p class="contact__ponderation__empty">Aucun projet n'a encore été ajouté à l'évènement.</p>
        @else
            <ul class="contact__ponderation__list">
                @foreach($projects as $project)
                    <li class="form__field">
                        <x-form.field
                            label="Projet {{ $project->name }}"
                            name="project_{{ $project->id }}_percentage"
                            type="number"
                            min="1"
                            max="100"
                            placeholder="Ex : {{ $remainingPercentage }}"
                            model="project_{{ $project->id }}_percentage"
                            :messages="$errors->get('projectPercentages.' . $project->id)"
                        />
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
