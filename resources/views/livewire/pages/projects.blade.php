{{-- Projects view --}}
<x-app-layout>
    <main class="mainProjects">
        <div class="projects__intro">
            <livewire:welcome-message
                    :title="'Bonjour ' . $user->name"
                    :message="'Découvrez la liste de tous vos projets.'"
            />
            <a href="{{ route('events.create') }}" class="ml-8 button--classic">Créer un nouveau projet</a>
        </div>

        {{-- Display all the projects --}}
        <table class="table-auto my-12">
            <thead>
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Nom</th>
                    <th class="px-4 py-2">Description</th>
                    <th class="px-4 py-2">Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $index => $project)
                    <tr>
                        <td class="border px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border px-4 py-2">{{ ucfirst($project->name) }}</td>
                        <td class="border px-4 py-2">{{ $project->description }}</td>
                        <td class="border px-4 py-2">{{ ucfirst($project->category) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Display all the projects --}}
        <div class="projects__list">
            @foreach($events->sortBy('starting_at') as $event)
                <h2 class="text-2xl font-bold mb-4">
                    {{ $event->name }}
                    {{-- Display the event's Date --}}
                    <span class="text-gray-600 text-sm ml-2">({{ $event->starting_at }})</span>
                    {{-- Display the event's Duration --}}
                    <span class="text-gray-600 text-sm ml-2">({{ $event->duration }} min)</span>
                </h2>
                <ul class="list-disc pl-8">
                    @foreach($projects->sortBy('name') as $project)
                        <li class="mb-4 border-b border-gray-200 pb-4">
                            Projet {{ $loop->iteration }}
                            <h3 class="text-lg font-bold leading-tight mb-2"><strong>Nom:</strong> {{ $project->name }}</h3>
                            <p class="text-gray-600 leading-tight mb-2"><strong>Description:</strong> {{ $project->description }}</p>
                            <p class="text-gray-600 leading-tight mb-2"><strong>Category:</strong> {{ $project->category }}</p>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </main>
</x-app-layout>
