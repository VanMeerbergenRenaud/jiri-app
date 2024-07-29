<div>
    <li class="item">
        <h3 class="item__name">{{ $event->name }}</h3>
        <div class="item__date">
            Date de l’épreuve<br>
            <time datetime="{{$event->starting_at}}">
                <span>{{ $this->formatDate($event->starting_at) }}</span>
            </time>
        </div>
        <div class="item__time">
            Durée de l’épreuve<br>
            <time datetime="{{ $event->duration }}">
                <span>{{ $this->formatTime($event->duration) }}</span>
            </time>
        </div>
        <div class="item__members">
            Participants<br>
            <p>
                <span>{{ $event->contacts_count ?? '0' }} enregistré{{ $event->contacts_count < 2 ? '' : 's' }}</span>
            </p>
        </div>
        {{-- Liens : Édition, Voir, Non disponible, Éditer, Supprimer --}}
        <div class="event__actions">
            <a href="{{ route('events.edit', ['event' => $event]) }}" wire:navigate class="link__edition">
                Configurer l'épreuve
            </a>

            @if($event->isAvailable())
                <x-dialog>
                    <x-dialog.open>
                        <button type="button" class="link__available">Démarrer</button>
                    </x-dialog.open>

                    <x-dialog.panel>
                        <form class="form" wire:submit.prevent="startEvent">
                            <div class="form__content">
                                <h2 class="title">Commencer l'épreuve&nbsp;:&nbsp;{{ $event->name }}</h2>
                                <ul class="event__actions__list">
                                    <li class="event__actions__list__item">
                                        <h3 class="event__actions__list__item__title">
                                            Informations importantes
                                        </h3>
                                        <p class="event__actions__list__item__text">
                                            Lorsque vous appuierez sur le bouton "Commencer", l'épreuve sera lancée et les participants pourront commencer à voter.
                                            Chaque évaluateur recevra un email avec un lien unique pour accéder à la plateforme de vote et un timer se lancera automatiquement
                                            pour voir la durée de l'épreuve. Assurez-vous que tout est prêt avant de lancer l'épreuve <span class="bold">{{ $event->name }}</span>.
                                        </p>
                                    </li>
                                    <li class="event__actions__list__item">
                                        <span class="event__actions__list__item__subtitle">
                                            Récapitulatif des informations de l'épreuve
                                        </span>
                                        <p class="event__actions__list__item__info">
                                            <span>Date de début&nbsp;:</span>
                                            {{ Carbon\Carbon::parse($event->starting_at)->format('d/m/Y à H\hi') }}
                                        </p>

                                        <p class="event__actions__list__item__info">
                                            <span>Durée prévue&nbsp;:</span>
                                            {{ Carbon\Carbon::parse($event->duration)->format('H\hi') }}
                                        </p>

                                        <p class="event__actions__list__item__info">
                                            <span>Participants&nbsp;:</span>
                                            {{ $event->contacts_count ?? '0' }}
                                        </p>

                                        <p class="event__actions__list__item__info">
                                            <span>Projets&nbsp;:</span>
                                            {{ $event->projects_count ?? '0' }}
                                        </p>
                                    </li>
                                </ul>
                                {{-- if there are no participants --}}
                                @if(session()->has('errorParticipants'))
                                    <div class="event__actions__list__error">
                                        <p class="event__actions__list__error__text">
                                            <x-svg.warning/>
                                            {{ session('errorParticipants') }}
                                        </p>
                                    </div>
                                @endif
                                {{-- if there are evaluators without email --}}
                                @if(session()->has('errorNoEvaluator'))
                                    <div class="event__actions__list__error">
                                        <p class="event__actions__list__error__text">
                                            <x-svg.warning/>
                                            {{ session('errorNoEvaluator') }}
                                        </p>
                                    </div>
                                @endif
                                {{-- if there are evaluators without email --}}
                                @if(session()->has('errorEvaluatorEmail'))
                                    <div class="event__actions__list__error">
                                        <p class="event__actions__list__error__text">
                                            <x-svg.warning/>
                                            {{ session('errorEvaluatorEmail') }}
                                        </p>
                                    </div>
                                @endif
                                {{-- if there are no projects --}}
                                @if(session()->has('errorNoProject'))
                                    <div class="event__actions__list__error">
                                        <p class="event__actions__list__error__text">
                                            <x-svg.warning/>
                                            {{ session('errorNoProject') }}
                                        </p>
                                    </div>
                                @endif
                            </div>

                            <x-dialog.footer>
                                <x-dialog.close>
                                    <button type="button" class="cancel">Annuler</button>
                                </x-dialog.close>

                                <button type="submit"
                                        class="save"
                                        wire:submit="startEvent">
                                    Commencer
                                </button>
                            </x-dialog.footer>
                        </form>
                    </x-dialog.panel>
                </x-dialog>
            @elseif($event->isCurrent())
                <a href="{{ route('events.show', ['event' => $event]) }}" wire:navigate class="link__current">Voir</a>
            @elseif($event->isPaused())
                <a href="{{ route('events.show', ['event' => $event]) }}" wire:navigate class="link__pause">Continuer</a>
            @elseif($event->isFinished())
                <a href="{{ route('events.show', ['event' => $event]) }}" wire:navigate class="link__finish">Récapitulatif</a>
            @else
                <button type="button" class="link__unavailable">Non disponible</button>
            @endif

            {{-- Actions menu --}}
            <x-menu>
                <x-menu.button>
                    <x-svg.dots/>
                </x-menu.button>

                <x-menu.items>
                    {{-- Dialog to edit a event --}}
                    <x-dialog wire:model="showEditDialog">
                        <x-dialog.open>
                            <x-menu.close>
                                <x-menu.item>
                                    <x-svg.edit/>

                                    Modifier
                                </x-menu.item>
                            </x-menu.close>
                        </x-dialog.open>

                        <x-dialog.panel>
                            <form wire:submit="save" class="form">
                                <div class="form__content">
                                    <h2 class="title">Modifier l'épreuve</h2>

                                    <x-form.field
                                        name="name"
                                        label="Nom de l'épreuve"
                                        type="text"
                                        model="form.name"
                                        placeholder="Ex : Jury juin {{ now()->year }}"
                                    />

                                    <x-form.field
                                        label="Date de début"
                                        name="starting_at"
                                        type="datetime-local"
                                        model="form.starting_at"
                                        min="2020-01-01T00:00"
                                        max="2038-01-01T00:00"
                                        placeholder="{{ now()->format('Y-m-d\TH:i') }}"
                                    />

                                    <x-form.field
                                        label="Durée de l'épreuve"
                                        name="duration"
                                        type="time"
                                        model="form.duration"
                                        min="00:01:00"
                                        max="23:59:00"
                                        placeholder="00:00:00"
                                    />
                                </div>

                                <x-dialog.footer>
                                    <x-dialog.close>
                                        <button type="button" class="cancel">Annuler</button>
                                    </x-dialog.close>

                                    <button type="submit" class="save">Sauvegarder</button>
                                </x-dialog.footer>
                            </form>
                        </x-dialog.panel>
                    </x-dialog>

                    <x-divider/>

                    {{-- Dialog to suppress a event--}}
                    <x-dialog>
                        <x-dialog.open>
                            <x-menu.close>
                                <x-menu.item>
                                    <x-svg.trash/>

                                    Supprimer
                                </x-menu.item>
                            </x-menu.close>
                        </x-dialog.open>

                        <x-dialog.panel>
                            <div x-data="{ confirmation: '' }">
                                <div class="panel__delete">
                                    <div class="advertising">
                                        <x-svg.advertising/>
                                        <div class="advertising__content">
                                            <h3 class="title">Supprimer l'épreuve</h3>
                                            <p class="description">
                                                Êtes-vous sûre de vouloir supprimer l'épreuve
                                                <span class="font-semibold"> {{ $event->name }} </span>&nbsp;? Toutes les données seront supprimées. Cette action est irréversible.
                                            </p>
                                            <label class="confirm-deletion">
                                                Veuillez tapper "CONFIRMER" pour confirmer la suppression.
                                                <input x-model="confirmation" placeholder="CONFIRMER">
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <x-dialog.footer>
                                    <x-dialog.close>
                                        <button type="button" class="cancel">Annuler</button>
                                    </x-dialog.close>

                                    <x-dialog.close>
                                        <button
                                            type="button"
                                            class="delete"
                                            :disabled="confirmation !== 'CONFIRMER'"
                                            wire:click="$dispatch('deleted')"
                                        >
                                            Supprimer
                                        </button>
                                    </x-dialog.close>
                                </x-dialog.footer>
                            </div>
                        </x-dialog.panel>
                    </x-dialog>
                </x-menu.items>
            </x-menu>
        </div>
    </li>

    @if($saved)
        <x-notifications
            icon="success"
            title="Épreuve modifiée avec succès"
            method="$set('saved', false)"
        />
    @endif
</div>
