<form wire:submit.prevent="editPonderation">
    @csrf

    <table class="bilan">
        <thead>
        <tr>
            <th class="bilan__head" colspan="100%">
                <h3>Bilan de l’étudiant</h3>

                <x-dialog>
                    <x-dialog.open>
                        <button type="button">
                            Editer les informations
                        </button>
                    </x-dialog.open>

                    <x-dialog.panel>
                        <div class="form__content">
                            <h2 class="title">Editer les informations</h2>
                            <p>
                                Editer les cotes ainsi que les pondérations des projets de l’étudiant.
                            </p>
                            <ul class="bilan__head__ponderation">
                                @foreach ($projects as $project)
                                    <li class="bilan__head__ponderation__list">
                                         <span class="bilan__head__ponderation__list__title">
                                             {{ ucfirst($project->project->name) }}
                                         </span>
                                        <x-form.field
                                            label="Pondération 1"
                                            name="ponderation1"
                                            placeholder="Ajouter une pondération"
                                            value="{{ $project->ponderation1 ?? '0' }}"
                                            type="number"
                                            min="0"
                                            max="100"
                                        />
                                        <x-form.field
                                            label="Pondération 2"
                                            name="ponderation2"
                                            placeholder="Ajouter une pondération"
                                            value="{{ $project->ponderation2 ?? '0' }}"
                                            type="number"
                                            min="0"
                                            max="100"
                                        />
                                    </li>
                                @endforeach
                            </ul>

                            {{-- Total of the ponderation --}}
                            <p class="bilan__head__ponderation__total">
                                <span>Total</span>
                                <span>Pondération 1 : {{ $projects->sum('ponderation1') }} %</span>
                                <span>Pondération 2 : {{ $projects->sum('ponderation2') }} %</span>
                            </p>
                        </div>

                        <x-dialog.footer>
                            <x-dialog.close>
                                <button type="button" class="cancel">Annuler</button>
                            </x-dialog.close>

                            <button type="button" wire:click="editPonderation" class="save">Sauvegardé
                            </button>
                        </x-dialog.footer>
                    </x-dialog.panel>
                </x-dialog>
            </th>
        </tr>
        </thead>
        <tbody>
        <!-- Ligne de titre -->
        <tr class="bilan__row">
            <th class="bilan__row__title">Projets</th>
            @foreach ($projects as $project)
                <td>
                    <span class="capitalize">{{ $project->project->name }}</span>
                </td>
            @endforeach
            <th class="global">Cote globale</th>
            <th class="final">Cote délibée</th>
        </tr>
        <!-- Ligne de moyenne et 1ère pondération -->
        <tr class="bilan__row">
            <th class="bilan__row__title">Moyenne des cotes</th>
            <!-- Moyenne des cotes par projet -->
            @foreach ($projects as $project)
                <td>
                    {{ $this->calculateAverageScore($project->project->id) }} / 20
                </td>
            @endforeach
            <!-- Cote globale -->
            <td class="global">
                <span class="note">{{ $this->calculateWeightedScore('ponderation1') }} / 20</span>
            </td>
            <!-- Cote de délibération -->
            <td rowspan="3" class="b-b b-r final">
                <span class="note">{{ $this->calculateWeightedScore('ponderation2') }} / 20</span>
            </td>
        </tr>
        <!-- Coéfficient de la cote globale pour chaque projet -->
        <tr class="bilan__row">
            <th rowspan="2" class="bilan__row__title b-b">Coéfficient de la cote globale en %</th>

            @foreach ($projects as $project)
                <td>
                    <span class="note">{{ $project->ponderation1 }} %</span>
                </td>
            @endforeach

            <td class="global">
                <span class="note">{{ $projects->sum(function ($project) {
                        return $project->ponderation1;
                    }) }} %
                </span>
            </td>
        </tr>
        <!-- Ligne de la 2ème pondération -->
        <tr class="bilan__row">
            @foreach ($projects as $project)
                <td class="b-b">
                    <span class="note">{{ $project->ponderation2 }} %</span>
                </td>
            @endforeach

            <td class="b-b global">
                <span class="note">
                    {{ $projects->sum(function ($project) {
                        return $project->ponderation2;
                    }) }} %
                </span>
            </td>
        </tr>
        </tbody>
    </table>
</form>
