<?php
namespace App\Livewire;

use App\Models\Jiri;
use App\Models\User;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Request;

class EventController extends Component
{
    public function index(User $user)
    {
        $jiris = Jiri::orderBy('starting_at','asc')->get();
        return view('livewire.events-list', compact('jiris', 'user'));
    }

    public function create(User $user): View
    {
        info('JiriController@index');
        return view('livewire.events/create', compact('user'));
    }

    public function show(User $user)
    {
        return view('livewire.events/show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('livewire.events/edit', compact('user'));
    }

    public function store(): RedirectResponse
    {
        $data = Request::validate([
            'name' => 'required',
            'starting_at' => 'required|date',
            'duration' => 'required|integer',
        ]);

        auth()->user()?->jiris()->create($data);
        return redirect('events');
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
