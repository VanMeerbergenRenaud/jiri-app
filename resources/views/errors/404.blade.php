<x-app-layout>
    <main class="grid h-full place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8">
        <div class="text-center">
            <p class="text-base font-semibold text-blue-600">404</p>
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">Page non trouvé...</h1>
            <p class="mt-6 text-base leading-7 text-gray-600">Désolé mon bro, je n'ai pas trouvé la page que tu demande</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="{{ route('dashboard') }}" class="rounded-md bg-blue-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Retourner à l'accueil
                </a>
            </div>
        </div>
    </main>
</x-app-layout>
