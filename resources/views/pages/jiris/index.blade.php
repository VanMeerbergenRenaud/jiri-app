<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Jiris') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @unless(empty($jiris))
                <ul>
                    @foreach($jiris as $jiri)
                        <li>{{ $jiri->name }}</li>
                    @endforeach
                </ul>
            @endunless
            <p>
                <a href="/jiris/create" class="inline-block mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create a new jiri
                </a>
            </p>
        </div>
    </div>

</x-app-layout>
