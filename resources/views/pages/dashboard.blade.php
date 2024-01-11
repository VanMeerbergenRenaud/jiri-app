<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-600">
                    <div class="px-4 py-2">
                        <h2 class="text-xl text-gray-900">Salut {{ $user->name }} !</h2>
                        <div class="mt-4 text-gray-900">
                            {{ __('Bienvenue sur votre tableau de bord. Vous pouvez voir ici toutes les informations concernant votre compte.') }}
                        </div>
                        <div class="mt-4">
                            {{ __('Vous avez ') . auth()->user()->events->count() . __(' évènements créés.') }}
                        </div>
                        <div class="mt-4">
                            {{ __('Vous avez ') . auth()->user()->contacts->count() . __(' contacts ajoutés.') }}
                        </div>
                        <div class="mt-4">
                            {{ __('Vous avez ') . auth()->user()->projects->count() . __(' projets créés avec un nombre total de ') . auth()->user()->tasks->count() . __(' tâches.') }}
                        </div>
                        <div class="mt-4">
                            {{ __('Vous avez ') . auth()->user()->attendances->count() . __(' participants à vos évènements.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
