{{-- Projects view --}}
<x-app-layout>
    <main class="mainProjects">
        <div class="projects__intro">
            <livewire:header
                    :title="'Bonjour ' . $user->name"
                    :message="'Découvrez la liste de tous vos projets.'"
            />
            <a href="{{ route('projects.create') }}" class="ml-8 button--classic">Créer un nouveau projet</a>
        </div>

        {{-- Display all the projects --}}
        <table class="table-auto my-12">
            <thead>
            <tr class="border px-4 py-2">
                <th class="px-4 py-2 border">#</th>
                <th class="px-4 py-2">Nom</th>
                <th class="px-4 py-2 border">Tâches</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2 border">Edit</th>
                <th class="px-4 py-2">Delete</th>
            </tr>
            </thead>
            <tbody x-data="{ search: '' }">
            <tr>
                <th colspan="100%">
                    <label for="search">
                        <input type="text" id="search" name="search" x-model="search" placeholder="Rechercher un projet..." class="w-full my-2 rounded p-4 border bg-transparent">
                    </label>
                </th>
            </tr>
            @if(count($projects) > 0)
                @foreach($projects as $project)
                    <template x-if="search === '' || '{{ $project->name }}'.toLowerCase().includes(search.toLowerCase())">
                        <tr>
                            <td class="border px-4 py-2">{{ $project->id }}</td>
                            <td class="border px-4 py-2">{{ ucfirst($project->name) }}</td>
                            <td class="border px-4 py-2">
                                @if(!empty($project->tasks))
                                    <ul>
                                        @foreach($project->tasks as $task)
                                            <li>{{ ucfirst($task->name) }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span>Aucune tâche n'est associée à ce projet.</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2">{{ $project->description }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('projects.edit', $project->id) }}">
                                    @include('components.svg.edit')
                                </a>
                            </td>
                            <td class="relative border px-4 py-2">
                                <form method="POST" action="{{ route('projects.destroy', $project->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" @click="showModal = true" class="ml-4">
                                        @include('components.svg.trash')
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </template>
                @endforeach
            @else
                <tr>
                    <td colspan="100%" class="border text-gray-700 px-4 py-2">Aucun projet à afficher pour le moment.</td>
                </tr>
            @endif
            </tbody>
        </table>

        {{-- Display all the projects --}}
        <div class="projects__list">
            Display all the events and there relative projects
            @foreach($events->sortBy('starting_at') as $event)
                <h2 class="text-2xl font-bold mb-4">
                    {{ $event->id }} - {{ $event->name }}
                    <span class="text-gray-600 text-sm ml-2">({{ $event->starting_at }})</span>
                    <span class="text-gray-600 text-sm ml-2">({{ $event->duration }} min)</span>
                </h2>
                <ul class="list-disc pl-8">
                    @foreach($event->duties->sortBy('name') as $duty)
                        <li class="mb-4 border-b border-gray-200 pb-4">
                            Projet {{ $loop->iteration }}
                            <h3 class="text-lg font-bold leading-tight mb-2"><strong>Nom:</strong> {{ $duty->name }}</h3>
                            @if(!empty($duty->project->tasks))
                                <ul>
                                    @foreach($duty->project->tasks as $task)
                                        <li>{{ ucfirst($task->name) }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-600 leading-tight mb-2">Aucune tâche n'est associée à ce projet.</p>
                            @endif
                            <span class="text-gray-600 leading-tight mb-2"><strong>Projet_id =</strong> {{ $duty->project_id }}</span>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </main>
</x-app-layout>
