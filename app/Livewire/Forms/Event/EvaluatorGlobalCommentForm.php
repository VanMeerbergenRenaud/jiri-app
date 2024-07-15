<?php


namespace App\Livewire\Forms\Event;

use App\Models\EvaluatorGlobalComment;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EvaluatorGlobalCommentForm extends Form
{
    #[Validate('required|min:3|max:255')]
    public $globalComment = '';

    #[Validate('required|numeric|min:0|max:20')]
    public $globalCote = '';

    public EvaluatorGlobalComment $evaluatorGlobalComment;

    public function setEvaluatorGlobalComment($evaluatorGlobalComment)
    {
        $this->evaluatorGlobalComment = $evaluatorGlobalComment;
        $this->globalComment = $evaluatorGlobalComment->globalComment;
        $this->globalCote = $evaluatorGlobalComment->globalCote;
    }

    public function save()
    {
        $this->validate();

        auth()->user()->evaluatorGlobalComments()->create([
            'globalComment' => $this->globalComment,
            'globalCote' => $this->globalCote,
        ]);

        $this->reset(['globalComment', 'globalCote']);
    }

    public function update()
    {
        $this->validate();

        $this->evaluatorGlobalComment->update([
            'globalComment' => $this->globalComment,
            'globalCote' => $this->globalCote,
        ]);
    }
}
