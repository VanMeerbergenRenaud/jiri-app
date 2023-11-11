{{-- Input for name, date and duration of the event --}}
<div class="form__infos">
    <label for="name">Nom de l'épreuve</label>
    <label for="starting_at">Date de début</label>
    <label for="duration">Durée de l'épreuve</label>
    <input
        type="text"
        name="name"
        id="name"
        min="1"
        placeholder="Ex : Design Web"
        value="{{ old('name') }}"
    >
    <input
        type="datetime-local"
        name="starting_at"
        id="starting_at"
        min="2023-01-01T00:00"
        max="3000-01-01T00:00"
        value="{{ old('starting_at') ?? date('Y-m-d\TH:i', strtotime('+1 hour')) }}"
    >
    <input
        type="number"
        name="duration"
        id="duration"
        min="1"
        max="480"
        value="{{ old('duration', 1) }}"
    >
    @error('name')<p class="error-message error1">{{ $message }}</p>@enderror
    @error('starting_at')<p class="error-message error2">{{ $message }}</p>@enderror
    @error('duration')<p class="error-message error3">{{ $message }}</p>@enderror
</div>
