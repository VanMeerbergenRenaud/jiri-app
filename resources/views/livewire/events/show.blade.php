<x-app-layout>
    <main class="mainEventShow">
        {{-- Component Start --}}
        <div class="events__intro">
            <div class="events__intro__info">
                <img src="{{ asset('img/dominique.png') }}" alt="Image de l'admin Dominique">
                <div>
                    <h2>Bonjour Dominique !</h2>
                    <p>Votre épreuve <em>Jury&nbsp;-&nbsp;17 juin 2023</em>&nbsp; vient de commencer.</p>
                </div>
            </div>
        </div>
        <div class="event__show" x-data="{ isFullScreen: false }" x-on:click.outside="isFullScreen = false">
            <div x-bind:class="{ 'fullscreen': isFullScreen }">
                <table>
                    <thead>
                    <tr class="row-1">
                        <th scope="col" x-bind:colspan="isFullScreen ? '11' : '6'">Tableau récapitulatif des passages</th>
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
                        <tr>
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
    </main>
</x-app-layout>
