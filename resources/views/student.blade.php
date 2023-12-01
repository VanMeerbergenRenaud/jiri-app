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
            <div class="mainProfil__content__col1">
                <div class="mainProfil__content__profil">
                    <div class="sectionHeader">
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
                            <input type="text" name="lastname" id="lastname" value="{{ $student->lastname ?? 'Non renseigné' }}">
                            <label for="firstname">Prénom</label>
                            <input type="text" name="firstname" id="firstname" value="{{ $student->firstname ?? 'Non renseigné' }}">
                            <label for="mail">Adresse mail</label>
                            <input type="email" name="mail" id="mail" value="{{ $student->mail ?? 'Non renseigné' }}">
                            <label for="site">Site de référence</label>
                            <input type="text" name="site" id="site" value="{{ $student->site ?? 'Non renseigné' }}">
                            <label for="github">Compte Github</label>
                            <input type="text" name="github" id="github" value="{{ $student->github ?? 'Non renseigné' }}">
                        </div>
                    </form>
                </div>
                <div class="globalComment">
                    <div class="sectionHeader">
                        <h4>Commentaire global</h4>

                        <a href="#">Editer le profil</a>
                    </div>
                    <form>
                        <label>
                            <textarea
                                x-data="{ resize: () => { $el.style.height = '0.5rem'; $el.style.height = $el.scrollHeight + 'px' } }"
                                x-init="resize()"
                                @input="resize()"
                            >{!! $globalComment ?? 'Pas encore de commentaires ajoutés...' !!}</textarea>
                        </label>
                    </form>
                </div>
            </div>
            <div class="mainProfil__content__col2">
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

                {{-- Comments of jiries --}}
                <div class="jiriesComment">
                    <h4>Commentaires des membres du jury</h4>
                    {{-- List of comments --}}
                    <ul class="jiriesComment__list">
                        @for ($i = 1; $i <= 3; $i++)
                            <li x-data="{ open: false, isSelected: false }" class="jiriesComment__list__item">
                                <div class="jiriesComment__list__item__infos" :class="{ 'isSelected': isSelected }" @click="open = !open; isSelected = !isSelected">
                                    <div class="jiriesComment__list__item__infos__evaluator">
                                        <img src="{{ asset('img/dominique.png') }}" alt="">
                                        <span>Toon van den boss</span>
                                    </div>
                                    <span>@include('components.svg.arrow-down')</span>
                                </div>

                                {{-- All the ratings & comments for all the projects of a student --}}
                                <ul x-show="open" x-transition.opacity class="jiriesComment__list__item__commentList">
                                    @for ($j = 1; $j <= 4; $j++)
                                        <li class="jiriesComment__list__item__commentList__item">
                                            <div>
                                                <h5>Nom du projet</h5>
                                                <span>11.5 / 20</span>
                                            </div>
                                            <p>
                                                La cote finale calculée automatiquement n’est pas forcément la cote finale qui se trouvera dans le bulletin de ok. La cote finale calculée automatiquement...
                                            </p>
                                        </li>
                                    @endfor
                                </ul>
                            </li>
                        @endfor
                    </ul>
                </div>

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
