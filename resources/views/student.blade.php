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
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th class="user-infos">
                                <div style="display: inline-block">
                                    <img src="" alt="">
                                    <span>Renaud Van Meerbergen</span>
                                </div>
                            </th>
                            <th>
                                <button>Editer les informations</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @for ($i = 1; $i <= 3; $i++)
                                <th>
                                    Projet {{ $i }}
                                </th>
                            @endfor
                        </tr>
                        <tr>
                            @for ($i = 1; $i <= 3; $i++)
                                <td>
                                    <h4>Projet présenté</h4>
                                    <p>Oui</p>
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            @for ($i = 1; $i <= 3; $i++)
                                <td>
                                    <h4>Réalisation(s)</h4>
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
                        <tr>
                            @for ($i = 1; $i <= 3; $i++)
                                <td>
                                    <h4>Maquette de design</h4>
                                    <a href="#">https://adobe.xd/cv-renaud.vmb</a>
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            @for ($i = 1; $i <= 3; $i++)
                                <td>
                                    <h4>Url du site</h4>
                                    <a href="#">https://renaud-vmb.com</a>
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            @for ($i = 1; $i <= 3; $i++)
                                <td>
                                    <h4>Repository GitHub</h4>
                                    <a href="#">https://github.com/VanMeerbergenRenaud/Portfolio</a>
                                </td>
                            @endfor
                        </tr>
                    </tbody>
                </table>
                <div class="mainProfil__action">
                    <h4>Action</h4>
                    <button>Changer le statut du profil</button>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
