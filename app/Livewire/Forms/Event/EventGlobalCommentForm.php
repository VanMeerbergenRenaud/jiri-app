<?php


namespace App\Livewire\Forms\Event;

use App\Models\EventGlobalComment;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EventGlobalCommentForm extends Form
{
    #[Validate('required|min:3|max:255')]
    public $globalComment = '';

    public EventGlobalComment $eventGlobalComment;

    public function setEventGlobalComment($eventGlobalComment)
    {
        $this->eventGlobalComment = $eventGlobalComment;
        $this->globalComment = $eventGlobalComment->globalComment;
    }

    public function save()
    {
        $this->validate();

        auth()->user()->eventGlobalComments()->create([
            'globalComment' => $this->globalComment,
        ]);

        $this->reset(['globalComment']);
    }

    public function update()
    {
        $this->validate();

        $this->eventGlobalComment->update([
            'globalComment' => $this->globalComment,
        ]);
    }
}
