<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;
use App\Models\Guideline;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class Guidelines extends Component
{
    use WithPagination;
    #[Rule('required|min:3')]
    public $guideline;
    public $search;
    public $editGuidelineID;

    #[Rule('required|min:3')]
    public $editGuideline;
    public function render()
    {
        return view('livewire.guidelines', [
            'guidelines' => Guideline::with('user')->where('guideline', 'like', "%{$this->search}%")->latest()->paginate(10)
        ]);
    }
    public function create()
    {
        $validated = $this->validateOnly('guideline');
        $validated['user_id'] = auth()->id();
        Guideline::create($validated);
        $this->reset('guideline');
        $this->resetPage();
        $this->dispatch('created');
    }

    public function edit(Guideline $guideline)
    {
        $this->editGuidelineID = $guideline->id;
        $this->editGuideline = $guideline->guideline;
    }

    public function delete(Guideline $guideline)
    {
        try {
            $this->dispatch('deleted');
            $guideline->delete();
        } catch (Exception $e) {
            session()->flash('flash', 'Failed to delete guideline!');
            return;
        }
    }

    public function cancelEdit()
    {
        $this->reset('editGuidelineID', 'editGuideline');
    }

    public function update()
    {
        try {
            $this->validateOnly('editGuideline');
            Guideline::find($this->editGuidelineID)->update(
                [
                    'guideline' => $this->editGuideline
                ]
            );
            $this->cancelEdit();
            $this->dispatch('updated');
        } catch (Exception $e) {
            session()->flash('message', 'Failed to edit guideline!');
            return;
        }
    }
}