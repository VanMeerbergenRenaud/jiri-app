<x-app-layout>
    <main class="mainEventShow">
        <div class="events__intro">
            <livewire:welcome-message
                :title="'Bonjour ' . $user->name . ' !'"
                :message="'Votre épreuve ' . $event->name . '  vient de commencer.'"
            />
        </div>

        {{-- First Table --}}
        <div class="event__show" x-data="{ isFullScreen: false }" x-on:click.outside="isFullScreen = false">
            <div x-bind:class="{ 'fullscreen': isFullScreen }">
                <table>
                    <thead>
                        <tr class="row-1">
                            <th scope="row" colspan="100%">Tableau récapitulatif des passages</th>
                        </tr>
                        <tr class="row-2">
                            <th class="category">Étudiants | Jury</th>
                            @for ($i = 1; $i <= 10; $i++)
                                <th class="jiris" scope="col">Jury {{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                    @for ($i = 1; $i <= 10; $i++)
                        <tr class="row-3">
                            <th class="students" scope="row" id="etudiant-{{ $i }}">Étudiant {{ $i }}</th>
                            @for ($j = 1; $j <= 10; $j++)
                                <td
                                    x-data="{ checked: localStorage.getItem('checkbox_state_{{$i}}_{{$j}}') === 'true' }"
                                    x-on:click="checked = !checked; localStorage.setItem('checkbox_state_{{$i}}_{{$j}}', checked)"
                                    headers="etudiant-{{ $i }} jury-{{ $j}}"
                                >
                                    <label>
                                        <input x-model="checked" class="input" type="checkbox">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="23" viewBox="0 0 19 23" x-show="checked">
                                            <text id="_" data-name="✔️" transform="translate(0 18)" fill="#00ba41" font-size="14" font-family="AppleColorEmoji, Apple Color Emoji"><tspan x="0" y="0">✔️</tspan>
                                            </text>
                                        </svg>
                                    </label>
                                </td>
                            @endfor
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
            <div class="button__right">
                <button class="button--classic" x-on:click="isFullScreen = !isFullScreen">
                    Mode plein écran
                </button>
            </div>
            <button class="button--classic close" x-show="isFullScreen" x-on:click="isFullScreen = false">
                Fermer
            </button>
        </div>

        {{-- Second Table --}}
        <div class="event__show__results">
            <h3>Tableau de résumé des cotes</h3>
            <table>
                <thead>
                {{-- First line for jiris members --}}
                <tr class="row-1">
                    <th scope="row" class="category sticky">Membres du jury</th>
                    @for ($i = 1; $i <= 4; $i++)
                        <th scope="col" colspan="3" class="jiris sticky-small">
                            <img src="{{ asset('img/dominique.png') }}" alt="photo d'un membre du jury">
                            Jury {{ $i }}
                        </th>
                    @endfor
                    <th rowspan="4" class="moy sticky">Moyenne</th>
                    <th rowspan="4" class="cg sticky">Cote globale</th>
                    <th rowspan="4" class="cga sticky">Cote globale avantageuse</th>
                    <th rowspan="4" class="cd sticky">Cote de délibée</th>
                </tr>
                {{-- Second line for projets --}}
                <tr class="row-2">
                    <th scope="row" class="category sticky">Étudiants&nbsp;|&nbsp;Projets</th>
                    @for ($i = 1; $i <= 4; $i++)
                        @for ($j = 1; $j <= 3; $j++)
                            <th class="project sticky-small">Projet {{ $j }}</th>
                        @endfor
                    @endfor
                </thead>
                <tbody>
                @for ($i = 1; $i <= 10; $i++)
                    <tr class="row-3">
                        {{-- Students --}}
                        <th scope="row" id="etudiant-{{ $i }}" class="students sticky">
                            <img src="{{ asset('img/dominique.png') }}" alt="photo de l'admin">
                            Étudiant {{ $i }}
                        </th>
                        {{-- Cotes ->  /20 --}}
                        @for ($j = 1; $j <= 4; $j++)
                            @for ($k = 1; $k <= 3; $k++)
                                <td headers="etudiant-{{ $i }} jury-{{ $j }} projet-{{ $k }}" class="results">
                                    9/20
                                </td>
                            @endfor
                        @endfor
                        {{-- Moyenne --}}
                        <td class="moy">9 / 20</td>
                        {{-- Cote globale --}}
                        <td class="cg">11 / 20</td>
                        {{-- Cote globale avantageuse --}}
                        <td class="cga">8 / 20</td>
                        {{-- Cote délibée --}}
                        <td class="cd">10 / 20</td>
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </main>
</x-app-layout>
