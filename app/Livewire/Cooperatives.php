<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\State;
use Livewire\Component;
use App\Models\Guideline;
use App\Models\CoopEiLine;
use App\Models\CoopAepaLine;
use App\Models\CoopCategory;
use Livewire\WithPagination;
use App\Models\CoopOmniaLine;
use App\Models\CoopEffectiveDate;

class Cooperatives extends Component
{
    use WithPagination;
    public $cooperative = 'aepa';
    public $category;
    public $search = '';
    public $perPage = 20;
    public $selected_state;
    public $states;
    public $pw = 'pw';
    public $effective_date_id;
    public $effective_date = '2023-01-01';
    public $effective_dates;
    public function mount()
    {
        $this->effective_date = CoopEffectiveDate::where('fk_coop', 2)->max('date');
        $this->effective_dates = CoopEffectiveDate::where('fk_coop', 2)->orderBy('date', 'DESC')->get();
        $this->states = State::whereNotNull(strtoupper($this->get_coop($this->cooperative, $this->pw)))->orderBy("State")->get();
    }

    public function render()
    {
        return view('livewire.cooperatives', [
            'lines' => $this->get_cooperative_lines($this->cooperative),
            'categories' => CoopCategory::whereNotNull(strtoupper($this->cooperative) . "_order")->cafilter($this->selected_state)->orderBy("Name", "ASC")->get(),
            'states' => State::where(($this->cooperative == 'aepa') ? 'aepa_npw' : $this->cooperative, '!=', null)->orderBy('State')->get(),
            'selected_state' => State::find($this->selected_state),
            'state_multiplier' => $this->state_multiplier($this->cooperative, $this->selected_state, $this->pw) ?? 1,
            'effective_date_id' => CoopEffectiveDate::where('id', $this->effective_date_id)->get(),
            'effective_date' => CoopEffectiveDate::where('id', $this->effective_date_id)->get(),
            'effective_dates' => $this->effective_dates,
        ]);
    }

    public function updatedCooperative($value)
    {
        $this->effective_dates = CoopEffectiveDate::where('fk_coop', function ($query) use ($value) {
            $query->select('id')->from('cooperatives')->where('Name', strtoupper($value));
        })->orderBy('date', 'DESC')->get();
        $this->effective_date = CoopEffectiveDate::where('fk_coop', function ($query) use ($value) {
            $query->select('id')->from('cooperatives')->where('Name', strtoupper($value));
        })->max('date');
        $this->effective_date_id = CoopEffectiveDate::select('id')->where('fk_coop', function ($query) use ($value) {
            $query->select('id')->from('cooperatives')->where('Name', strtoupper($value));
        })->max('date');
        $this->category = '';
        $this->selected_state = '';
        $this->search = '';
    }

    public function updatedEffectiveDateId($date_id)
    {
        $this->effective_date = CoopEffectiveDate::where('id', '=', $date_id)->value('date');
    }

    public function max_effective_date()
    {
        $this->effective_date_id = CoopEffectiveDate::where('fk_coop', function ($query) {
            $query->select('id')->from('cooperatives')->where('Name', '=', strtoupper($this->cooperative));
        })->max('date');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedCategory()
    {
        $this->resetPage();
    }

    protected function get_cooperative_lines($coop)
    {
        if ($coop == 'aepa') {
            $query = CoopAepaLine::leftjoin('unit_of_measurements', 'unit_of_measurements.id', '=', 'coop_aepa_lines.fk_UOM')
                ->leftjoin('coop_categories', 'coop_categories.id', '=', 'coop_aepa_lines.fk_category')
                ->search(trim($this->search))
                ->category($this->category, $this->selected_state)
                ->paginate($this->perPage);
        } else if ($coop == 'ei') {
            $query = CoopEiLine::leftjoin('unit_of_measurements', 'unit_of_measurements.id', '=', 'coop_ei_lines.fk_UOM')
                ->leftjoin('coop_categories', 'coop_categories.id', '=', 'coop_ei_lines.fk_category')
                ->search(trim($this->search))
                ->category($this->category)
                ->paginate($this->perPage);
        } else if ($coop == 'omnia') {
            $query = CoopOmniaLine::leftjoin('unit_of_measurements', 'unit_of_measurements.id', '=', 'coop_omnia_lines.fk_UOM')
                ->leftjoin('coop_categories', 'coop_categories.id', '=', 'coop_omnia_lines.fk_category')
                ->search(trim($this->search))
                ->category($this->category)
                ->paginate($this->perPage);
        }
        return $query;
    }

    protected function state_multiplier($coop, $state, $pw)
    {
        $column = ($coop == 'aepa') ? (($pw) ? 'aepa_pw' : 'aepa_npw') : $coop;
        $multiplier = optional(State::select($column)->find($state))->$column;
        return $multiplier;
    }

    protected function get_coop($coop, $pw)
    {
        $output = ($coop == 'aepa') ? (($pw) ? 'aepa_pw' : 'aepa_npw') : $coop;
        return $output;
    }
}