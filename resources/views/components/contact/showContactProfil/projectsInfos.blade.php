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
                    {{ $project->project->name }}
                </th>
            @endforeach
        </tr>
        <tr class="project-info">
            @foreach ($projects as $project)
                <td>
                    <h4 class="title">Projet présenté</h4>
                    <p>Oui</p>
                </td>
            @endforeach
        </tr>
        <tr class="project-info">
            @foreach ($projects as $project)
                <td>
                    <h4 class="title">Réalisation(s)</h4>
                    <ul>
                        <li>
                            {{--{{ ucwords(implode(' | ', json_decode($project->project->tasks))) ?? "Non renseigné" }}--}}
                        </li>
                    </ul>
                </td>
            @endforeach
        </tr>
        <tr class="project-info">
            @foreach ($projects as $project)
                <td>
                    <h4 class="title">Maquette de design</h4>
                    <a href="{{ $project->design ?? "#" }}" class="link" title="Vers la maquette de design">
                        {{ $project->design ?? "https://adobe.xd/cv-renaud.vmb" }}
                    </a>
                </td>
            @endforeach
        </tr>
        <tr class="project-info">
            @foreach ($projects as $project)
                <td>
                    <h4 class="title">Url du site</h4>
                    <a href="{{ $project->site ?? "#" }}" class="link" title="Vers le site du projet">
                        {{ $project->site ?? "Non renseigné" }}
                    </a>
                </td>
            @endforeach
        </tr>
        <tr class="project-info">
            @foreach ($projects as $project)
                <td>
                    <h4 class="title">Repository GitHub</h4>
                    <a href="{{ $project->github ?? "#" }}" class="link" title="Vers le repository GitHub">
                        {{ $project->github ?? "https://github.com/VanMeerbergenRenaud/jiri-app" }}
                    </a>
                </td>
            @endforeach
        </tr>
    </tbody>
</table>
