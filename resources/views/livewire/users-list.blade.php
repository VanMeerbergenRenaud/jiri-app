<div>
    <label for="search" wire:model.live="username">
        <input type="text" name="search" id="search">
    </label>
    @foreach($this->users as $user)
        <p>{{ $user->name }}</p>
    @endforeach
</div>
