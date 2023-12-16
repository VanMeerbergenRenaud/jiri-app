<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageUpload extends Component
{
    use WithFileUploads;

    #[Validate(['image' => 'image|max:1024'])]
    public $image;

    public function save()
    {
        $this->validate();

        $name = $this->image->getClientOriginalName();
        $path = $this->image->storeAs('images', $name, 'public');

        $this->contact()->image()->create([
            'name' => $name,
            'path' => $path,
        ]);

        session()->flash('message', 'Image successfully Uploaded.');
    }

    public function render()
    {
        return view('livewire.image-upload')->layout('layouts.app');
    }
}
