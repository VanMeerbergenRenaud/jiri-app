<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a new jiri') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('jiris.store') }}" method="post">
                @csrf
                <div class="p-4 mb-3">
                    <label for="name">Name</label>
                    <input class="p-2" type="text" name="name" id="name">
                </div>
                <div class="p-4 mb-3">
                    <label for="starting_at">Starting date and time</label>
                    <input class="p-2" type="datetime-local" name="starting_at" id="starting_at">
                </div>
                <div class="p-4 mb-3">
                    <label for="duration">Duration in minutes</label>
                    <input class="p-2" type="number" name="duration" id="duration" min="1" max="480" value="1">
                </div>
                <div class="mt-6">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Create this jiri</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
