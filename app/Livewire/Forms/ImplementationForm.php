<?php

namespace App\Livewire\Forms;

use App\Models\Implementation;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ImplementationForm extends Form
{
    #[Validate('required|min:3')]
    public $url = '';

    #[Validate('required|min:3')]
    public $score = '';

    public Implementation $implementation;

    public function setImplementation($implementation)
    {
        $this->implementation = $implementation;
        $this->url = $implementation->url;
        $this->score = $implementation->score;
    }

    public function save()
    {
        $this->validate();

        auth()->user()->implementations()->create([
            'url' => $this->url,
            'score' => $this->score,
        ]);

        $this->reset(['url', 'score']);
    }

    public function update()
    {
        $this->validate();

        $this->implementation->update([
            'url' => $this->url,
            'score' => $this->score,
        ]);
    }
}
