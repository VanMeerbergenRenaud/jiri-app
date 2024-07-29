<div>
    <livewire:evaluator.header :evaluator="$evaluator" :event="$event" />

    <main class="mainEvaluationEdit">

        {{-- Naviagtion & breadcrumb --}}
        <x-evaluation-nav :event="$event" :evaluator="$evaluator" :token="$token"/>

        {{-- Evaluate de project --}}
        <form class="evaluationForm" wire:submit.prevent="addEvaluation">
            @csrf

            <section class="evaluationEdit">
                <h2 role="heading" aria-level="2" class="sr-only">Informations sur le projet</h2>
                <div class="evaluationEdit__header">
                    <img src="{{ $student->avatar ?? asset('img/placeholder.png') }}" alt="{{ $student->name }}">
                    <p>{{ $student->name }} {{ $student->firstname }}</p>
                </div>
                <ul class="evaluationEdit__list">
                    <li class="evaluationEdit__list__item">
                        <span class="label">Url du projet</span>
                        <a href="{{ $project->url_readme ?? '#' }}" target="_blank" class="link">
                            {{ $project->url_readme ?? 'non renseigné' }}
                        </a>
                    </li>
                    <li class="evaluationEdit__list__item">
                        <span class="label">Repository Github</span>
                        <a href="{{ $project->student->github ?? '#' }}" target="_blank" class="link">
                            {{ $project->student->github ?? 'non renseigné' }}
                        </a>
                    </li>
                    <li class="evaluationEdit__list__item item__tasks">
                        <span class="label">Présentation</span>
                        <p>
                            @foreach($tasks as $task)
                                <span>{{ $task->name ?? 'non mentionné' }}</span> |
                            @endforeach
                        </p>
                    </li>
                    <hr>
                    {{--timer--}}
                    {{-- TODO : déclencher le timer lorsque l'utilisateur est sur la page --}}
                    <li class="evaluationEdit__list__item item">
                        <x-form.field
                            label="Temps passé"
                            name="timer"
                            type="time"
                            model="timer"
                            value="{{ $timer ?? '00:00:00' }}"
                            placeholder="00:00:00"
                        />
                    </li>
                    <li class="evaluationEdit__list__item">
                        <label for="eventStatus" class="label">Status</label>
                        <select name="eventStatus" id="eventStatus" wire:model.blur="status">
                            <option disabled selected value="">Choisir un status</option>
                            <option value="evaluated">Vu</option>
                            <option value="not evaluated">Non vu</option>
                        </select>
                    </li>
                    <li class="evaluationEdit__list__item">
                        <label for="eventReview" class="label">Cote du projet</label>
                        <div class="eventReview">
                            <select name="eventReview" id="eventReview" wire:model="score">
                                <option disabled selected value="">Choisir une appréciation</option>
                                <option value="0">A besoin d'un miracle</option>
                                <option value="2">Peut mieux faire</option>
                                <option value="4">Pas fou fou</option>
                                <option value="6">Pas mauvais</option>
                                <option value="8">On sent un effort</option>
                                <option value="10">Travail honnête</option>
                                <option value="12">Belle tentative</option>
                                <option value="14">Presque parfait</option>
                                <option value="16">Excellent boulot</option>
                                <option value="18">Champion en herbe</option>
                                <option value="20">Chef-d'œuvre</option>
                            </select>
                            <span class="eventReview__score">
                                <input type="text" wire:model="score"/>/ 20
                            </span>
                        </div>
                        @error('score')
                            <ul class="error-message">
                                <li class="error-message__item">{{ $message }}</li>
                            </ul>
                        @enderror
                    </li>
                    <li class="evaluationEdit__list__item eventComment">
                        <x-form.textarea
                            label="Commentaire"
                            name="comment"
                            model="comment"
                            placeholder="Inscrivez un commentaire…"
                        />
                    </li>
                </ul>
            </section>
            <div class="evaluationEdit__footer">
                <button type="submit"
                        class="button--gray"
                        wire:click="addEvaluation"
                >Publier globalement</button>
            </div>
        </form>
    </main>

    <footer class="footerEvaluator">
        <p>Tableau de bord de {{ $evaluator->name ?? 'Nom inconnu' }}</p>
        <p class="copyright">Copyright - Tous droits réservés</p>
        <p>Épreuve - {{ $event->name ?? 'Épreuve non mentionnée' }}</p>
    </footer>
</div>
