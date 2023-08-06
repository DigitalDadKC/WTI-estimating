<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Guideline;

class AddGuideline extends Component
{
    public $guideline;
    public $user_id;

    protected $rules = [
        'guideline' => 'required'
    ];

    protected $validationAttributes = [
        'guideline' => 'guideline'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->guideline = '';
    }

    public function addGuideline()
    {
        $validatedData = $this->validate();
        $validatedData['user_id'] = auth()->id();
        Guideline::create($validatedData);
        $this->reset('guideline');
        $this->emit('guidelineAdded');
        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.add-guideline');
    }
}