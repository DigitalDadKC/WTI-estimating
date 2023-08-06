<?php

namespace App\Http\Livewire;

use App\Models\Guideline;
use Livewire\Component;

class AllGuidelines extends Component
{
    public $guidelines = [];
    public $editedGuidelineIndex = null;
    public $editedGuidelineField = null;
    protected $listeners = ['guidelineAdded'];
    protected $rules = [
        'guidelines.*.guideline' => 'required'
    ];
    protected $validationAttributes = [
        'guidelines.*.guideline' => 'guidelines',
    ];

    public function mount()
    {
        $this->guidelines = Guideline::with('User')->latest()->get()->toArray();
    }

    public function editGuideline($guidelineIndex)
    {
        $this->editedGuidelineIndex = $guidelineIndex;
    }
    public function editGuidelineField($guidelineIndex, $fieldName)
    {
        $this->editedGuidelineField = $guidelineIndex . '.' . $fieldName;
    }
    public function saveGuideline($guidelineIndex)
    {
        $this->validate();
        $guideline = $this->guidelines[$guidelineIndex] ?? NULL;
        if (!is_null($guideline)) {
            optional(Guideline::find($guideline['id']))->update(['guideline' => $guideline['guideline']]);
        }
        $this->editedGuidelineIndex = null;
        $this->editedGuidelineField = null;
        $this->emit('updated');
    }
    public function deleteGuideline($guidelineIndex)
    {
        $guideline = $this->guidelines[$guidelineIndex];
        optional(Guideline::find($guideline['id']))->delete($guideline);
        $this->guidelines = Guideline::with('User')->latest()->get()->toArray();
        $this->emit('deleted');
    }

    public function guidelineAdded()
    {
        $this->guidelines = Guideline::with('User')->latest()->get()->toArray();
    }

    public function render()
    {
        return view('livewire.all-guidelines', [
            'guidelines' => $this->guidelines,
        ]);
    }
}