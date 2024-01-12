<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white py-2 px-8">
                    <h2 class="text-xl py-6 text-gray-900">Salut {{ $user->name }} !</h2>
                    <p>{{ __('Bienvenue sur votre tableau de bord. Vous pouvez voir ici un aperçu de vos dernières statistiques.') }}</p>
                    <div class="mx-auto max-w-7xl px-6 lg:px-8 mt-8 py-12">
                        <div class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">
                            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                                <p class="text-base leading-7 text-gray-600">
                                    {{ __('créés au total en tant qu‘organisateur.') }}
                                </p>
                                <p class="order-first text-2xl font-semibold tracking-tight text-gray-900">
                                    @if(auth()->user()->events->count() > 0)
                                        {{ auth()->user()->events->count() . __(' évènements') }}
                                    @else
                                        {{ __('Aucun évènement') }}
                                    @endif
                                </p>
                            </div>
                            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                                <p class="text-base leading-7 text-gray-600">
                                    {{ __('avec plus de ') . auth()->user()->attendances->count() . __(' participants.') }}
                                </p>
                                <p class="order-first text-2xl font-semibold tracking-tight text-gray-900">
                                    @if(auth()->user()->contacts->count() > 0)
                                        {{ auth()->user()->contacts->count() . __(' contacts ajoutés') }}
                                    @else
                                        {{ __('Aucun contact ajouté') }}
                                    @endif
                                </p>
                            </div>
                            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                                <p class="text-base leading-7 text-gray-600">
                                    {{ __('avec plus de ') . auth()->user()->tasks->count() . __(' tâches.') }}
                                </p>
                                <p class="order-first text-2xl font-semibold tracking-tight text-gray-900">
                                    @if(auth()->user()->projects->count() > 0)
                                        {{ auth()->user()->projects->count() . __(' projets créés') }}
                                    @else
                                        {{ __('Aucun projet créé') }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
