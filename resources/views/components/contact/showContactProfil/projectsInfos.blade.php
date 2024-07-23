<table class="infosTable">
    <thead>
        <tr>
            <th class="user-infos" colspan="100%">
                <div>
                    <img src="{{ $contact->avatar ?? asset('img/placeholder.png') }}"
                         alt="Photo du contact">
                    <span>
                        {{ $contact->name }} {{ $contact->firstname }}
                    </span>
                </div>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr class="project-list">
            @foreach ($projects as $project)
                <th>
                    {{ $project->project->name ?? 'Projet inconnu' }}
                </th>
            @endforeach
        </tr>
        <tr class="project-info">
            @foreach ($projects as $project)
                <td>
                    <h4 class="title">Projet présenté</h4>
                    <p>
                        {{ $project->project->status ?? 'Non présenté' }}
                    </p>
                </td>
            @endforeach
        </tr>
        <tr class="project-info">
            @foreach ($projects as $project)
                <td>
                    <h4 class="title">Réalisation(s)</h4>
                    <ul>
                        <li>
                            {{--@foreach ($project->project->tasks as $task)
                                {{ $task->name ?? 'Non renseigné' }} |
                            @endforeach--}}
                        </li>
                    </ul>
                </td>
            @endforeach
        </tr>
        <tr class="project-info">
            @foreach ($projects as $project)
                <td>
                    <h4 class="title">Maquette de design</h4>
                    <a href="{{ $project->design ?? "#" }}" target="_blank" class="link" title="Vers la maquette de design">
                        {{ $project->design ?? "https://adobe.xd/renaud.vmb" }}
                    </a>
                </td>
            @endforeach
        </tr>
        <tr class="project-info">
            @foreach ($projects as $project)
                <td>
                    <h4 class="title">Url du site</h4>
                    <a href="{{ $project->project->url_readme ?? "#" }}" target="_blank" class="link" title="Vers le site du projet">
                        {{ $project->project->url_readme ?? "Non renseigné" }}
                    </a>
                </td>
            @endforeach
        </tr>
        <tr class="project-info">
            @foreach ($projects as $project)
                <td>
                    <h4 class="title">Repository GitHub</h4>
                    <a href="{{ $project->github ?? "#" }}" target="_blank" class="link" title="Vers le repository GitHub">
                        {{ $project->github ?? "https://github.com/VanMeerbergenRenaud/jiri-app" }}
                    </a>
                </td>
            @endforeach
        </tr>
    </tbody>
</table>
