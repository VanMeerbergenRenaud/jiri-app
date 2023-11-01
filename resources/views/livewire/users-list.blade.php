<div class="user__list">
    <label for="search" wire:model.live="username">
        <input type="text" name="search" id="search" class="input" placeholder="Search a user">
    </label>
    @foreach($this->users as $user)
        <div class="item">
            <p class="text">{{ $user->name }}</p>
            <a href="#" class="link">Ajouter</a>
        </div>
    @endforeach
</div>
