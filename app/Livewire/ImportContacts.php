<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportContacts extends Component
{
    use WithFileUploads;

    public $imported = false;

    #[Validate(['upload' => 'required|mimes:csv,txt'])]
    public $upload;

    public $columns;

    public $fieldColumnMap = [
        'name' => '',
        'firstname' => '',
        'email' => '',
    ];

    protected $rules = [
        'fieldColumnMap.name' => 'required',
        'fieldColumnMap.firstname' => 'required',
    ];

    protected $messages = [
        'fieldColumnMap.name.required' => 'The name column is required.',
        'fieldColumnMap.firstname.required' => 'The firstname column is required.',
    ];

    public function updatedUpload()
    {
        $this->columns = Csv::from($this->upload)->columns();
    }

    public function extractFieldsFromRow($row)
    {
        return collect($this->fieldColumnMap)
            ->filter()
            ->mapWithKeys(function ($heading, $field) use ($row) {
                return [$field => $row[$heading]];
            })
            ->toArray();
    }

    public function import() {
        $this->validate();

        Csv::from($this->upload)
            ->eachRow(function ($row) {
                auth()->user()->contacts()->create(
                    $this->extractFieldsFromRow($row));
            });

        $this->reset();

        $this->imported = true;
    }
}
