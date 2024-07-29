<div>
    <div class="mainProfil__content">
        <div class="mainProfil__content__col1">
            <div class="mainProfil__content__profil">
                {{-- Profil infos + form --}}
                <x-contact.showContactProfil.profilInfos
                    :contact="$contact"
                    :contactType="$contactType"
                    :form="$form"
                />
            </div>

            @if($contactType  === 'student')
                {{-- Global comment + form --}}
                <x-contact.showContactProfil.globalComment
                    :globalComment="$globalComment"
                />
            @endif
        </div>
        <div class="mainProfil__content__col2">
            @if($contactType === 'student')

                {{-- Bilan + form for ponderations --}}
                <x-contact.showContactProfil.bilanTable
                    :contact="$contact"
                    :projects="$projects"
                />

                {{-- Comments of evaluators for student --}}
                <x-contact.showContactProfil.commentsStudent
                    :contact="$contact"
                    :contact-type="$contactType"
                    :evaluators="$evaluators"
                    :projects="$projects"
                    :evaluationsOfEvaluators="$evaluationsOfEvaluators"
                />

                {{-- Table of the projects informations of the student --}}
                <x-contact.showContactProfil.projectsInfos
                    :contact="$contact"
                    :projects="$projects"
                />
            @else
                {{-- Comments of evaluator for students --}}
                <x-contact.showContactProfil.commentsEvaluator
                    :contact="$contact"
                    :contact-type="$contactType"
                    :students="$students"
                    :projects="$projects"
                    :evaluationsFromEvaluator="$evaluationsFromEvaluator"
                />
            @endif
            {{-- Action --}}
            <form class="mainProfil__action" wire:submit.prevent="editContactRole">
                @csrf
                <h4 class="title">Action</h4>
                <button type="button" wire:click="editContactRole" class="button--gray">Changer le statut du profil</button>
            </form>
        </div>
    </div>
    <div>
        @if($commentSaved)
            <x-notifications
                icon="success"
                title="Commentaire global modifié"
                message="Le commentaire global a été modifié avec succès."
                method="$set('commentSaved', false)"
            />
        @endif
    </div>
</div>
