{{-- AddedListContact of projects --}}
<div class="form__component__added">
    <p>Projets ajoutés</p>
    @if(count($projectsList) > 0)
        <ul>
            @foreach($projectsList as $project)
                <li wire:key="{{ $project->project->id }}">
                    <span class="category capitalize">{{ $project->project->name ?? 'Pas de nom' }}</span>
                    <span class="username">
                        {{ $project->project->url_readme }}
                    </span>

                    <x-dialog>
                        <x-dialog.open>
                            <button class="button--white" type="button">
                                @include('components.svg.trash2')
                            </button>
                        </x-dialog.open>

                        <x-dialog.panel>
                            <div class="form__content">
                                <h2 role="heading" aria-level="2" class="title">Suppression du projet de l'épreuve</h2>
                                <p>Êtes-vous sûr de vouloir supprimer le projet <span class="bold">{{ ucfirst($project->project->name) }}</span> de l'épreuve ?</p>
                            </div>

                            <x-dialog.footer>
                                <x-dialog.close>
                                    <button type="button" class="cancel">Annuler</button>
                                </x-dialog.close>

                                <button type="button" wire:click="removeProject({{ $project->id }})" class="save">Oui</button>
                            </x-dialog.footer>
                        </x-dialog.panel>
                    </x-dialog>

                </li>
            @endforeach
        </ul>
    @else
        <p class="no-contact">Aucun projet ajouté pour le moment.</p>
    @endif
</div>
