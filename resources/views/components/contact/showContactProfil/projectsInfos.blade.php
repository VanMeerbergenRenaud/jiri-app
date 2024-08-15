<table class="infosTable">
    <thead>
        <tr>
            <th class="user-infos" colspan="100%">
                <div>
                    <h3 role="heading" aria-level="3" class="sr-only">Informations sur les projets</h3>
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
                    <span class="title">Projet présenté</span>
                    <p>
                        {{ $project->project->status ?? 'Non présenté' }}
                    </p>
                </td>
            @endforeach
        </tr>
        <tr class="project-info">
            @foreach ($projects as $project)
                <td>
                    <span class="title">Réalisation(s)</span>
                    <ul>
                        <li>
                            @foreach ($project->project->tasks as $task)
                                {{ $task->name ?? 'Non renseigné' }} |
                            @endforeach
                        </li>
                    </ul>
                </td>
            @endforeach
        </tr>
        <tr class="project-info">
            @foreach ($projects as $project)
                <td>
                    <span class="title">Maquette de design</span>
                    <a href="{{ $project->design ?? "#" }}" target="_blank" class="link" title="Vers la maquette de design">
                        {{ $project->design ?? "https://adobe.xd/renaud.vmb" }}
                    </a>
                </td>
            @endforeach
        </tr>
        <tr class="project-info">
            @foreach ($projects as $project)
                <td>
                    <span class="title">Url du site</span>
                    <a href="{{ $project->project->url_readme ?? "#" }}" target="_blank" class="link" title="Vers le site du projet">
                        {{ $project->project->url_readme ?? "Non renseigné" }}
                    </a>
                </td>
            @endforeach
        </tr>
        <tr class="project-info">
            @foreach ($projects as $project)
                <td>
                    <span class="title">Repository GitHub</span>
                    <a href="{{ $project->github ?? "#" }}" target="_blank" class="link" title="Vers le repository GitHub">
                        {{ $project->github ?? "https://github.com/VanMeerbergenRenaud/jiri-app" }}
                    </a>
                </td>
            @endforeach
        </tr>
    </tbody>
</table>
