<div>
    <div class="mainProfil__content">
        <div class="mainProfil__content__col1">
            <div class="mainProfil__content__profil">
                <div class="sectionHeader">
                    Profil

                    <x-dialog wire:model="showEditDialog">
                        <x-dialog.open>
                            <button type="button">Editer le profil</button>
                        </x-dialog.open>
                        <x-dialog.panel>
                            <x-contact.editForm :contact="$contact" :form="$form"/>
                        </x-dialog.panel>
                    </x-dialog>
                </div>
                {{-- Form to edit a profil --}}
                <div class="mainProfil__content__profil__form">
                    <label for="Photo">Photo</label>
                    <div class="mainProfil__content__profil__form__photo">
                        <div>
                            <img src="{{ $contact->avatar ?? asset('img/placeholder.png') }}" alt="Photo de l'étudiant">
                            <span>
                                @include('components.svg.edit')
                            </span>
                        </div>
                        <span>
                            Accepte les fichiers de type<br>
                            .jpg, .jpeg, .png ou .svg<br>
                        </span>
                    </div>
                    {{-- Nom, prénom, adresse mail, site de référence et compte Github --}}
                    <div class="mainProfil__content__profil__form__infos">
                        <h3 class="title">Nom</h3>
                        <p class="text">{{ $contact->name }}</p>

                        <h3 class="title">Prénom</h3>
                        <p class="text">{{ $contact->firstname }}</p>

                        <h3 class="title">Adresse mail</h3>
                        <p class="text">{{ $contact->email ?? 'Non renseigné' }}</p>

                        <h3 class="title">Site de référence</h3>
                        <p class="text">{{ $contact->site ?? 'Non renseigné' }}</p>

                        <h3 class="title">Compte GitHub</h3>
                        <p class="text">{{ $contact->github ?? 'Non renseigné' }}</p>
                    </div>
                </div>
            </div>

            @if($contactType  === 'student')
                {{-- Form to edit the globalComment --}}
                <form class="globalComment" wire:submit.prevent="saveGlobalComment">
                    @csrf

                    <div class="sectionHeader">
                        <h3>Commentaire global</h3>

                        <x-dialog>
                            <x-dialog.open>
                                <button type="button">
                                    Editer
                                </button>
                            </x-dialog.open>

                            <x-dialog.panel>
                                <div class="form__content">
                                    <h2 class="title">Commentaire global</h2>
                                    <p class="text">
                                        Veuillez ajouter un commentaire global pour l’étudiant.
                                    </p>
                                    <x-form.textarea
                                        label="Commentaire global"
                                        name="globalComment"
                                        model="globalComment"
                                        placeholder="Ajouter un commentaire global"
                                        value="{{ $globalComment }}"
                                        srOnly="true"
                                        maxlength="1000"
                                        class="globalComment__textarea"
                                    />
                                </div>

                                <x-dialog.footer>
                                    <x-dialog.close>
                                        <button type="button" class="cancel">Annuler</button>
                                    </x-dialog.close>

                                    <button type="button" wire:click="saveGlobalComment"
                                            class="save">Enregistrer
                                    </button>
                                </x-dialog.footer>
                            </x-dialog.panel>
                        </x-dialog>
                    </div>

                    <p class="globalComment__text">
                        {{ $globalComment }}
                    </p>
                </form>
            @endif

        </div>
        <div class="mainProfil__content__col2">
            @if($contactType === 'student')
                {{-- Bilan --}}
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
                    <tr class="bilan__row">
                        <th class="bilan__row__title">Moyenne des cotes</th>
                        @foreach ($projects as $project)
                            <td>
                                <span class="note">4</span>
                                <span>/ 20</span>
                            </td>
                        @endforeach
                        {{-- TODO : <td> is the AVG of the result --}}
                        <td class="global">
                            <span class="note">4.35</span>
                            <span>/ 20</span>
                        </td>
                        {{-- TODO : cote délibée --}}
                        <td rowspan="3" class="b-b b-r final">
                            <span class="note">14.4</span>
                            <span>/ 20</span>
                        </td>
                    </tr>
                    <tr class="bilan__row">
                        <th rowspan="2" class="bilan__row__title b-b">Coéfficient de la cote globale</th>

                        @foreach ($projects as $project)
                            <td>
                                <span class="note">{{ $project->ponderation1 / 100 }}</span>
                            </td>
                        @endforeach

                        {{-- TODO : cote globale * les coéficients--}}
                        <td class="global">
                                <span class="note">{{ $projects->sum(function ($project) {
                                        return $project->ponderation1;
                                    }) }} %
                                </span>
                        </td>
                    </tr>
                    <tr class="bilan__row">
                        @foreach ($projects as $project)
                            <td class="b-b">
                                <span class="note">{{ $project->ponderation2 / 100 }}</span>
                            </td>
                        @endforeach
                        {{-- TODO : cote globale2 * les coéficients--}}
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

                {{-- Comments of jiries --}}
                <div class="jiriesComment">
                    <h3 class="title">Commentaires des membres du jury</h3>
                    {{-- List of comments --}}
                    <ul class="jiriesComment__list">
                        @foreach ($evaluators as $evaluator)
                            {{-- for each $comments from evaluators --}}
                            <li x-data="{ open: false, isSelected: false }" class="jiriesComment__list__item">
                                <div class="jiriesComment__list__item__infos" :class="{ 'isSelected': isSelected }"
                                     @click="open = !open; isSelected = !isSelected">
                                    <div class="jiriesComment__list__item__infos__evaluator">
                                        <img src="{{ $evaluator->contact->avatar ?? asset('img/placeholder.png') }}" alt="Photo de l'évaluateur">
                                        <span>
                                            {{ $evaluator->contact->name ?? 'Évaluateur' }} {{ $evaluator->contact->firstname ?? 'inconnu' }}
                                        </span>
                                    </div>
                                    <span>
                                        @include('components.svg.arrow-down')
                                    </span>
                                </div>

                                {{-- All the ratings & comments for all the projects of a student --}}
                                <ul x-show="open" x-transition.opacity class="jiriesComment__list__item__commentList">
                                    @foreach ($projects as $project)
                                        <li class="jiriesComment__list__item__commentList__item">
                                            <div>
                                                <h4 class="font-semibold capitalize">
                                                    {{ $project->project->name ?? 'Projet inconnu' }}
                                                </h4>
                                                <span>
                                                    @if($evaluationOfEachEvaluatorForStudent
                                                            ->where('project_id', $project->project->id)
                                                            ->where('event_contact_id', $evaluator->contact->id)->isEmpty())
                                                        ? / 20
                                                    @else
                                                        @foreach($evaluationOfEachEvaluatorForStudent
                                                                ->where('project_id', $project->project->id)
                                                                ->where('event_contact_id', $evaluator->contact->id) as $test)
                                                            {{ $test->score ?? 'Non renseigné' }} / 20
                                                        @endforeach
                                                    @endif
                                                </span>
                                            </div>
                                            <p>
                                                @if($evaluationOfEachEvaluatorForStudent
                                                        ->where('project_id', $project->project->id)
                                                        ->where('event_contact_id', $evaluator->contact->id)->isEmpty())
                                                    Aucun commentaire n’a encore été enregistré jusqu’à présent pour ce projet.
                                                @else
                                                    @foreach($evaluationOfEachEvaluatorForStudent
                                                            ->where('project_id', $project->project->id)
                                                            ->where('event_contact_id', $evaluator->contact->id) as $test)
                                                        {{ $test->comment ?? 'Aucun commentaire n’a encore été enregistré jusqu’à présent pour ce projet.' }}
                                                    @endforeach
                                                @endif
                                            </p>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Basic table --}}
                <table class="infosTable">
                    <thead>
                    <tr>
                        <th class="user-infos" colspan="100%">
                            <div>
                                <img src="{{ $contact->avatar ?? asset('img/placeholder.png') }}" alt="Photo du contact">
                                <span>
                                    {{ $contact->name }} {{ $contact->firstname }}
                                </span>
                            </div>
                            {{--<a href="#">Editer les informations</a>--}}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="project-list">
                        @foreach ($projects as $project)
                            <th>
                                {{ $project->project->name }}
                            </th>
                        @endforeach
                    </tr>
                    <tr class="project-info">
                        @foreach ($projects as $project)
                            <td>
                                <h4 class="title">Projet présenté</h4>
                                <p>Oui</p>
                            </td>
                        @endforeach
                    </tr>
                    <tr class="project-info">
                        @foreach ($projects as $project)
                            <td>
                                <h4 class="title">Réalisation(s)</h4>
                                <ul>
                                    <li>
                                        {{--{{ ucwords(implode(' | ', json_decode($project->project->tasks))) ?? "Non renseigné" }}--}}
                                    </li>
                                </ul>
                            </td>
                        @endforeach
                    </tr>
                    <tr class="project-info">
                        @foreach ($projects as $project)
                            <td>
                                <h4 class="title">Maquette de design</h4>
                                <a href="{{ $project->design ?? "#" }}" class="link" title="Vers la maquette de design">
                                    {{ $project->design ?? "https://adobe.xd/cv-renaud.vmb" }}
                                </a>
                            </td>
                        @endforeach
                    </tr>
                    <tr class="project-info">
                        @foreach ($projects as $project)
                            <td>
                                <h4 class="title">Url du site</h4>
                                <a href="{{ $project->site ?? "#" }}" class="link" title="Vers le site du projet">
                                    {{ $project->site ?? "Non renseigné" }}
                                </a>
                            </td>
                        @endforeach
                    </tr>
                    <tr class="project-info">
                        @foreach ($projects as $project)
                            <td>
                                <h4 class="title">Repository GitHub</h4>
                                <a href="{{ $project->github ?? "#" }}" class="link" title="Vers le repository GitHub">
                                    {{ $project->github ?? "https://github.com/VanMeerbergenRenaud/jiri-app" }}
                                </a>
                            </td>
                        @endforeach
                    </tr>
                    </tbody>
                </table>
            @else
                <div class="jiriesComment">
                    <div class="jiriesComment__head">
                        <img src="{{ $contact->avatar ?? asset('img/placeholder.png') }}" alt="Photo du contact">
                        <span>
                            {{ $contact->name }} {{ $contact->firstname }}
                        </span>
                    </div>
                    {{-- List of comments --}}
                    <ul class="jiriesComment__list">

                        {{-- TODO : Informations à propos des commentaires écris par un évaluateur pour un étudiant en particulier --}}
                        {{-- 1. Liste des étudiants évalué --}}
                        {{-- 2. Liste des commentaires pour chaque étudiant --}}
                        {{-- 3. Liste de chaque commentaire pour chaque travail présenté par un étudiant --}}

                        @if($contactType === 'evaluator')
                            @foreach ($students as $student)
                                <li x-data="{ open: false, isSelected: false }" class="jiriesComment__list__item">
                                    <div class="jiriesComment__list__item__infos" :class="{ 'isSelected': isSelected }"
                                         @click="open = !open; isSelected = !isSelected">
                                        <div class="jiriesComment__list__item__infos__evaluator">
                                            <img src="{{ $student->contact->avatar ?? asset('img/placeholder.png') }}" alt="Photo de l'évaluateur">
                                            <span>
                                                {{ $student->contact->name }} {{ $student->contact->firstname }}
                                            </span>
                                        </div>
                                        <span>@include('components.svg.arrow-down')</span>
                                    </div>

                                    {{-- All the ratings & comments for all the projects of a student --}}
                                    <ul x-show="open" x-transition.opacity
                                        class="jiriesComment__list__item__commentList">
                                        @foreach ($projects as $project)
                                            <li class="jiriesComment__list__item__commentList__item">
                                                <div>
                                                    <h3 class="font-semibold capitalize">
                                                        {{ $project->project->name ?? 'Projet inconnu' }}
                                                    </h3>
                                                    <span>
                                                        @if($evaluationOfEvaluatorForEachStudent
                                                                ->where('project_id', $project->project->id)
                                                                ->where('contact_id', $student->contact->id)->isEmpty())
                                                            ? / 20
                                                        @else
                                                            @foreach($evaluationOfEvaluatorForEachStudent
                                                                    ->where('project_id', $project->project->id)
                                                                    ->where('contact_id', $student->contact->id) as $test)
                                                                {{ $test->score ?? 'Non renseigné' }} / 20
                                                            @endforeach
                                                        @endif
                                                    </span>
                                                </div>
                                                <p>
                                                    @if($evaluationOfEvaluatorForEachStudent
                                                            ->where('project_id', $project->project->id)
                                                            ->where('contact_id', $student->contact->id)->isEmpty())
                                                        Aucun commentaire n’a encore été enregistré jusqu’à présent pour ce projet.
                                                    @else
                                                        @foreach($evaluationOfEvaluatorForEachStudent
                                                                ->where('project_id', $project->project->id)
                                                                ->where('contact_id', $student->contact->id) as $test)
                                                            {{ $test->comment ?? 'Aucun commentaire n’a encore été enregistré jusqu’à présent pour ce projet.' }}
                                                        @endforeach
                                                    @endif
                                                </p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        @else
                            <p class="empty">
                                Aucune cote n’a encore été enregistrée jusqu’à présent.
                            </p>
                        @endif
                    </ul>
                </div>
            @endif
            {{-- Action --}}
            <form class="mainProfil__action" wire:submit.prevent="editContactRole">
                @csrf
                <h4 class="title">Action</h4>
                <button type="button" wire:click="editContactRole" class="button--gray">Changer le statut du profil</button>
            </form>
        </div>
    </div>
</div>
