<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    {{-- Display all the infos of a user --}}
                    <div class="flex flex-col mt-4">
                        <p class="font-bold">{{ $user->name }}</p>
                        <p class="text-gray-600">{{ $user->email }}</p>
                        <p class="text-gray-600">id : {{ $user->id }}</p>
                        <p class="text-gray-600">created_at : {{ $user->created_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
