<div>
    <main class="mainEvaluationEdit">

        {{-- Naviagtion & breadcrumb --}}
        <x-evaluation-nav/>

        {{-- Evaluate de project --}}
        <form action="" class="evaluationForm">
            @csrf

            <section class="evaluationEdit">
                <h2 role="heading" aria-level="2" class="sr-only">Informations sur le projet</h2>
                <div class="evaluationEdit__header">
                    {{--<img src="{{ $contact->avatar }}" alt="{{ $contact->name }}">
                    <p>{{ $contact->name }} {{ $contact->firstname }}</p>--}}
                    <img src="{{ asset('img/placeholder.png') }}" alt="}">
                    <p>Renaud Van Meerbergen</p>
                </div>
                <ul class="evaluationEdit__list">
                    <li class="evaluationEdit__list__item">
                        <span class="label">Url du projet</span>
                        <a href="" class="link">renaud-vmb.com</a>
                    </li>
                    <li class="evaluationEdit__list__item">
                        <span class="label">Repository Github</span>
                        <a href="" class="link">github.com/renaudvmb/portfolio</a>
                    </li>
                    <li class="evaluationEdit__list__item">
                        <span class="label">Présentation</span>
                        <p>Design | Intégration | WP</p>
                    </li>
                    <hr>
                    <li class="evaluationEdit__list__item">
                        <label for="eventStatus" class="label">Status</label>
                        <select name="eventStatus" id="eventStatus">
                            <option value="vu">Vu</option>
                            <option value="non-vu">Non vu</option>
                        </select>
                    </li>
                    <li class="evaluationEdit__list__item">
                        <label for="eventReview" class="label">Cote du projet</label>
                        <p class="eventReview" x-data="{ score: 0 }">
                            <select name="eventReview" id="eventReview" x-model="score">
                                <option disabled selected value="">Choisir une appréciation</option>
                                <option value="0">A besoin d'un miracle</option>
                                <option value="2">Peut mieux faire</option>
                                <option value="4">Pas mal du tout</option>
                                <option value="6">Pas fou fou</option>
                                <option value="8">On sent un effort</option>
                                <option value="10">Travail honnête</option>
                                <option value="12">Belle tentative</option>
                                <option value="14">Presque parfait</option>
                                <option value="16">Excellent boulot</option>
                                <option value="18">Champion en herbe</option>
                                <option value="20">Chef-d'œuvre</option>
                            </select>
                            <span class="eventReview__score">
                        <span x-text="score">0</span>/20
                    </span>
                        </p>
                    </li>
                    <li class="evaluationEdit__list__item eventComment">
                        <label for="eventComment" class="label">Commentaire</label>
                        <textarea name="eventComment" id="eventComment" cols="30" rows="10" placeholder="Inscrivez un commentaire…"></textarea>
                    </li>
                </ul>
            </section>
            <div class="evaluationEdit__footer">
                <button type="submit" class="button--gray">Publier globalement</button>
            </div>
        </form>
    </main>

    <footer class="footerEvaluator">
        <p>Tableau de bord de {{ $evaluator->name ?? 'John Doe' }}</p>
        <p class="copyright">Copyright - Tous droits réservés</p>
        <p>Épreuve - {{ $event->name ?? 'Épreuve du jour' }}</p>
    </footer>
</div>
