<x-app-layout>
    {{-- Student profil page --}}
    <main class="mainProfil">
        <div class="mainProfil__intro">
            <h3>Profil d'un étudiant</h3>
            <p>Découvrez toutes les informations du profil ci-dessous.</p>
        </div>
        <div class="mainProfil__nav">
            <a href="/" class="button--gray">
                @include('components.svg.arrow-left')
                Retour
            </a>
            <button type="button" class="button--gray">
                Choisir un autre étudiant
                @include('components.svg.arrow-down')
            </button>
        </div>
        <div class="mainProfil__content">
            <div class="mainProfil__content__profil">
                <div class="mainProfil__content__profil__header">
                    <h4>Profil</h4>

                    <a href="#">Editer le profil</a>
                </div>
                {{-- Form to edit a profil --}}
                <form action="" method="post" class="mainProfil__content__profil__form">
                    @csrf
                    @method('PUT')

                    <label for="Photo">Photo</label>
                    <div class="mainProfil__content__profil__form__photo">
                        <div>
                            <img src="{{ asset('img/dominique.png') }}" alt="Photo de l'étudiant">
                            <button type="button">
                                @include('components.svg.edit')
                            </button>
                        </div>
                        <span>
                            Accepte les fichiers<br>
                            de type .png et .jpg
                        </span>
                    </div>
                    {{-- Nom, prénom, adresse mail, site de référence et compte Github --}}
                    <div class="mainProfil__content__profil__form__container">
                        <label for="lastname">Nom</label>
                        <input type="text" name="lastname" id="lastname" value="{{--{{ $student->firstname }}--}}">
                        <label for="firstname">Prénom</label>
                        <input type="text" name="firstname" id="firstname" value="{{--{{ $student->lastname }}--}}">
                        <label for="mail">Adresse mail</label>
                        <input type="email" name="mail" id="mail" value="{{--{{ $student->mail }}--}}">
                        <label for="site">Site de référence</label>
                        <input type="text" name="site" id="site" value="{{--{{ $student->site }}--}}">
                        <label for="github">Compte Github</label>
                        <input type="text" name="github" id="github" value="{{--{{ $student->github }}--}}">
                    </div>
                </form>
            </div>
            <div class="mainProfil__content__infos">
                <table class="bilan">
                    <thead>
                    <tr>
                        <th class="bilan__head" colspan="100%">
                            <h3>Bilan de l’étudiant</h3>
                            <a href="#">Editer les informations</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $testCol = 7;
                    @endphp
                    <tr class="bilan__row">
                        <th class="bilan__row__title">Projets</th>
                        @for ($i = 1; $i <= $testCol; $i++)
                            <th>
                                Projet {{ $i }}
                            </th>
                        @endfor
                        <th class="global">Cote globale</th>
                        <th class="final">Cote délibée</th>
                    </tr>
                    <tr class="bilan__row">
                        <th class="bilan__row__title">Moyenne des cotes</th>
                        @for ($i = 1; $i <= $testCol; $i++)
                            <td>
                                <span class="note">4</span>
                                <span>/ 20</span>
                            </td>
                        @endfor
                        {{-- TODO : <td> is the AVG of the result --}}
                        <td class="global">
                            <span class="note">4.35</span>
                            <span>/ 20</span>
                        </td>
                        {{-- TODO : cote délibée --}}
                        <td rowspan="3" class="b-b b-r final">
                            <span class="note">14.4</span>
                            <span>/ 20</span>
                        </td>
                    </tr>
                    <tr class="bilan__row">
                        <th rowspan="2" class="bilan__row__title b-b">Coéfficient de la cote globale</th>
                        @for ($i = 1; $i <= $testCol; $i++)
                            <td>
                                <span class="note">0.2</span>
                            </td>
                        @endfor
                        {{-- TODO : cote globale * les coéficients--}}
                        <td class="global">
                            <span class="note">4.25</span>
                        </td>
                    </tr>
                    <tr class="bilan__row">
                        @for ($i = 1; $i <= $testCol; $i++)
                            <td class="b-b">
                                <span class="note">0.35</span>
                            </td>
                        @endfor
                            {{-- TODO : cote globale2 * les coéficients--}}
                            <td class="b-b global">
                                <span class="note">4.75</span>
                                <span>/ 20</span>
                            </td>
                    </tr>
                    </tbody>
                </table>

                {{-- Basic table --}}
                <table class="infosTable">
                    <thead>
                        <tr>
                            <th class="user-infos" colspan="100%">
                                <div>
                                    <img src="{{ asset('img/dominique.png') }}" alt="">
                                    <span>Renaud Van Meerbergen</span>
                                </div>
                                <a href="#">Editer les informations</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $testCol = 7;
                    @endphp
                        <tr class="project-list">
                            @for ($i = 1; $i <= $testCol; $i++)
                                <th>
                                    Projet {{ $i }}
                                </th>
                            @endfor
                        </tr>
                        <tr class="project-info">
                            @for ($i = 1; $i <= $testCol; $i++)
                                <td>
                                    <h4 class="title">Projet présenté</h4>
                                    <p>Oui</p>
                                </td>
                            @endfor
                        </tr>
                        <tr class="project-info">
                            @for ($i = 1; $i <= $testCol; $i++)
                                <td>
                                    <h4 class="title">Réalisation(s)</h4>
                                    <ul>
                                        @for ($j = 1; $j <= 3; $j++)
                                            <li>
                                                Design UI
                                            </li>
                                        @endfor
                                    </ul>
                                </td>
                            @endfor
                        </tr>
                        <tr class="project-info">
                            @for ($i = 1; $i <= $testCol; $i++)
                                <td>
                                    <h4 class="title">Maquette de design</h4>
                                    <a href="#" class="link">https://adobe.xd/cv-renaud.vmb</a>
                                </td>
                            @endfor
                        </tr>
                        <tr class="project-info">
                            @for ($i = 1; $i <= $testCol; $i++)
                                <td>
                                    <h4 class="title">Url du site</h4>
                                    <a href="#" class="link">https://renaud-vmb.com</a>
                                </td>
                            @endfor
                        </tr>
                        <tr class="project-info">
                            @for ($i = 1; $i <= $testCol; $i++)
                                <td>
                                    <h4 class="title">Repository GitHub</h4>
                                    <a href="#" class="link">https://github.com/VanMeerbergenRenaud/Portfolio</a>
                                </td>
                            @endfor
                        </tr>
                    </tbody>
                </table>
                <div class="mainProfil__action">
                    <h4 class="title">Action</h4>
                    <button type="button" class="button--gray">Changer le statut du profil</button>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
