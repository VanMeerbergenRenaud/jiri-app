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
                @isset($event->contacts)
                    <span>{{ $event->contacts->count() }} enregistrés</span>
                @else
                    <span>0 enregistré</span>
                @endisset
            </p>
        </div>
        {{-- Liens : Édition, Voir, Non disponible, Éditer, Supprimer --}}
        <div class="event__actions">
            <a href="{{ route('events.edit', ['event' => $event]) }}" wire:navigate class="link__edition">
                Configurer l'épreuve
            </a>

            @php
                $starting_at = Carbon\Carbon::parse($event->starting_at);
                $duration = Carbon\Carbon::parse($event->duration);
                $ending_at = $starting_at->addHours($duration->hour)->addMinutes($duration->minute)->addSeconds($duration->second);
            @endphp

            @if($event->starting_at <= now() || ($event->starting_at <= now() && $ending_at >= now()))
                <a href="{{ route('events.show', ['event' => $event]) }}" wire:navigate class="link__see">Voir</a>
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
                    <x-dialog wire:model="showEditDialog" style="width: 100%">
                        <x-dialog.open>
                            <x-menu.close>
                                <x-menu.item>
                                    <div class="button">
                                        <x-svg.edit/>

                                        Modifier
                                    </div>
                                </x-menu.item>
                            </x-menu.close>
                        </x-dialog.open>

                        <x-dialog.panel>
                            <form wire:submit="save" class="form">
                                <div class="form__content">
                                    <h2 class="title">Modifier l'épreuve</h2>

                                    <label>
                                        Nom
                                        <input
                                            type="text"
                                            name="name"
                                            wire:model="form.name"
                                            placeholder="Nom de l'épreuve"
                                            autofocus
                                            min="1"
                                        >
                                        @error('form.name')<div class="error">{{ $message }}</div>@enderror
                                    </label>

                                    <label>
                                        Date de début
                                        <input
                                            type="datetime-local"
                                            name="starting_at"
                                            wire:model="form.starting_at"
                                            min="2020-01-01T00:00"
                                            max="2038-01-01T00:00"
                                            placeholder="JJ/MM/AAAA HH:MM"
                                        />
                                        @error('form.starting_at')<div class="error">{{ $message }}</div>@enderror
                                    </label>

                                    <label>
                                        Durée
                                        <input
                                            type="time"
                                            name="duration"
                                            wire:model="form.duration"
                                            min="00:01:00"
                                            max="23:59:59"
                                            placeholder="HH:MM:SS"
                                        />
                                        @error('form.duration')<div class="error">{{ $message }}</div>@enderror
                                    </label>
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

                    {{-- Dialog to suppress a event--}}
                    <x-dialog class="w-full">
                        <x-dialog.open>
                            <x-menu.close>
                                <x-menu.item>
                                    <div class="button">
                                        <x-svg.trash/>

                                        Supprimer
                                    </div>
                                </x-menu.item>
                            </x-menu.close>
                        </x-dialog.open>

                        <x-dialog.panel>
                            <div x-data="{ confirmation: '' }">
                                <div class="panel__delete">
                                    <div class="advertising">
                                        <x-svg.advertising/>
                                        <div class="advertising__content">
                                            <h3 class="title">Supprimer le event</h3>
                                            <p class="description">
                                                Êtes-vous sûre de vouloir supprimer le event
                                                <strong> {{ $event->name }} {{ $event->firstname }}</strong>&nbsp;? Toutes les données seront supprimées. Cette action est irréversible.
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
</div>
