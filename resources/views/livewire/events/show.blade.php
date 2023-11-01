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
        <div class="event__show">
            <table>
                <thead>
                    <tr>
                        <th class="table-head" scope="col" colspan="6">Tableau récapitulatif des passages</th>
                    </tr>
                    <tr class="first">
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
                            <td x-data="{ checked: false }" x-on:click="checked = !checked" headers="etudiant-{{ $i }} jury-{{ $j}}">
                                <label>
                                    <input x-model="checked" class="input" type="checkbox">
                                </label>
                            </td>
                        @endfor
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </main>
</x-app-layout>
