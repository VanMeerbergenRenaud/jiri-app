<div class="header__infos">
    <img src="{{ auth()->user()->avatarUrl() ?? asset('img/placeholder.png') }}" alt="Avatar du profil">
    <div>
        <h2 class="title">{{ $title }}</h2>
        <p class="text">{{ $message }}</p>
    </div>
</div>
