<div class="intro__infos">
    <img src="{{ auth()->user()->avatarUrl() ?? asset('img/dominique.png') }}" alt="Photo de profil">
    <div>
        <h2 class="title">{{ $title }}</h2>
        <p class="text">{{ $message }}</p>
    </div>
</div>
