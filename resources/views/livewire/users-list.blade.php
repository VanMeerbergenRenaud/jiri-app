<div>
    <label for="search" wire:model.live="username">
        <input type="text" name="search" id="search" class="p-2 w-72 border border-gray-300 rounded-md">
    </label>
    <div class="mb-2">
        @foreach($this->users as $user)
            <div class="p-4 mt-2 rounded bg-white flex items-center justify-between">
                <p>{{ $user->name }}</p>
                <a href="#" class="text-blue-500 hover:underline">Ajouter</a>
            </div>
        @endforeach
    </div>
</div>
