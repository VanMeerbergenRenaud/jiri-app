<div class="events__intro__info">
    <img src="{{ auth()->user()->avatarUrl() ?? asset('img/dominique.png') }}" alt="Photo de profil">
    <div>
        <h2>{{ $title }}</h2>
        <p>{{ $message }}</p>
    </div>
</div>
