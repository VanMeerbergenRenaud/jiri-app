{{-- AddedList of contacts --}}
@php
    $roleTranslations = [
        'student' => 'Étudiant',
        'evaluator' => 'Évaluateur',
    ];
    $students = $eventContactsList->where('role', 'student');
    $evaluators = $eventContactsList->where('role', 'evaluator');
@endphp
<div class="form__component__added">
    <p>Contacts ajoutés</p>
    @if(count($eventContactsList) > 0)
        {{-- Students --}}
        <ul>
            <span class="form__component__added__category">
               👨🏻‍🎓 {{ count($students) > 1 ? 'Les étudiants' : 'Étudiant' }}&nbsp;:
            </span>
            @if(count($students) > 0)
                @foreach($students as $student)
                    <li wire:key="{{ $student->id }}">
                        <span class="category capitalize">{{ $roleTranslations[$student->role] ?? 'Neutre' }}</span>
                        <span class="username capitalize">{{ $student->contact->name ?? 'Contact inconnu' }}</span>

                        <x-dialog>
                            <x-dialog.open>
                                <button class="button--white exchange" type="button">
                                    @include('components.svg.rotate')
                                </button>
                            </x-dialog.open>

                            <x-dialog.panel>
                                <div class="form__content">
                                    <h2 class="title">Changement de rôle</h2>
                                    <p>Êtes-vous sûr de vouloir échanger le rôle de <span class="bold">{{ ucfirst($student->contact->name) }}</span> en évaluateur ?</p>
                                </div>

                                <x-dialog.footer>
                                    <x-dialog.close>
                                        <button type="button" class="cancel">Annuler</button>
                                    </x-dialog.close>

                                    <button type="button" wire:click="exchangeRole({{ $student->id }})" class="save">Oui</button>
                                </x-dialog.footer>
                            </x-dialog.panel>
                        </x-dialog>
                        <x-dialog>
                            <x-dialog.open>
                                <button class="button--white" type="button">
                                    @include('components.svg.trash2')
                                </button>
                            </x-dialog.open>

                            <x-dialog.panel>
                                <div class="form__content">
                                    <h2 class="title">Suppression du contact de l'épreuve</h2>
                                    <p>Êtes-vous sûr de vouloir supprimer l'étudiant <span class="bold">{{ ucfirst($student->contact->name) }}</span> de l'épreuve ?</p>
                                </div>

                                <x-dialog.footer>
                                    <x-dialog.close>
                                        <button type="button" class="cancel">Annuler</button>
                                    </x-dialog.close>

                                    <button type="button" wire:click="removeContact({{ $student->id }})" class="save">Oui</button>
                                </x-dialog.footer>
                            </x-dialog.panel>
                        </x-dialog>
                    </li>
                @endforeach
            @else
                <p class="no-contact">Aucun étudiant ajouté pour le moment.</p>
            @endif
        </ul>

        {{-- Evaluators --}}
        <ul>
            <span class="form__component__added__category">
                👨🏻‍⚖️ {{ count($evaluators) > 1 ? 'Les évaluateurs' : 'Évaluateur' }}&nbsp;:
            </span>
            @if(count($evaluators) > 0)
                @foreach($evaluators as $evaluator)
                    <li wire:key="{{ $evaluator->id }}">
                        <span class="category capitalize">{{ $roleTranslations[$evaluator->role] ?? 'Neutre' }}</span>
                        <span class="username capitalize">{{ $evaluator->contact->name ?? 'Contact inconnu' }}</span>

                        <x-dialog>
                            <x-dialog.open>
                                <button class="button--white exchange" type="button">
                                    @include('components.svg.rotate')
                                </button>
                            </x-dialog.open>

                            <x-dialog.panel>
                                <div class="form__content">
                                    <h2 class="title">Changement de rôle</h2>
                                    <p>Êtes-vous sûr de vouloir échanger le rôle de <span class="bold">{{ ucfirst($evaluator->contact->name) }}</span> en étudiant ?</p>
                                </div>

                                <x-dialog.footer>
                                    <x-dialog.close>
                                        <button type="button" class="cancel">Annuler</button>
                                    </x-dialog.close>

                                    <button type="button" wire:click="exchangeRole({{ $evaluator->id }})" class="save">Oui</button>
                                </x-dialog.footer>
                            </x-dialog.panel>
                        </x-dialog>
                        <x-dialog>
                            <x-dialog.open>
                                <button class="button--white" type="button">
                                    @include('components.svg.trash2')
                                </button>
                            </x-dialog.open>

                            <x-dialog.panel>
                                    <div class="form__content">
                                        <h2 class="title">Suppression du contact de l'épreuve</h2>
                                        <p>Êtes-vous sûr de vouloir supprimer l'évaluateur <span class="bold">{{ ucfirst($evaluator->contact->name) }}</span> de l'épreuve ?</p>
                                    </div>

                                    <x-dialog.footer>
                                        <x-dialog.close>
                                            <button type="button" class="cancel">Annuler</button>
                                        </x-dialog.close>

                                        <button type="button" wire:click="removeContact({{ $evaluator->id }})" class="save">Oui</button>
                                    </x-dialog.footer>
                            </x-dialog.panel>
                        </x-dialog>
                    </li>
                @endforeach
            @else
                <p class="no-contact">Aucun évaluateur ajouté pour le moment.</p>
            @endif
        </ul>
    @else
        <p class="no-contact">Aucun contact ajouté pour le moment.</p>
    @endif
</div>
