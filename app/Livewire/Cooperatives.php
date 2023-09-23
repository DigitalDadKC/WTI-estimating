<?php

namespace App\Livewire;

use App\Models\CoopEffectiveDate;
use App\Models\State;
use Livewire\Component;
use App\Models\CoopEiLine;
use App\Models\CoopAepaLine;
use App\Models\CoopCategory;
use Livewire\WithPagination;
use App\Models\CoopOmniaLine;

class Cooperatives extends Component
{
    use WithPagination;
    public $cooperative = 'aepa';
    public $category;
    public $search = '';
    public $perPage = 20;
    public $state;
    public $pw = 'pw';
    public $effective_date;

    // <option value="{{date('m_d_Y',strtotime($date->date))}}" @selected(date('m_d_Y',strtotime($date->date)) == $effective_date)>{{date("F d, Y",strtotime($date->date))}}</option>




    public function render()
    {
        return view('livewire.cooperatives', [
            'lines' => $this->get_cooperative_lines($this->cooperative),
            'categories' => CoopCategory::where(strtoupper($this->cooperative) . "_order", '!=', null)->cafilter($this->state)->orderBy("Name", "ASC")->get(),
            'states' => State::where(($this->cooperative == 'aepa') ? 'aepa_npw' : $this->cooperative, '!=', null)->orderBy('State')->get(),
            'state_multipliers' => State::find($this->state),
            'multiplier' => $this->get_multiplier($this->cooperative, $this->state, $this->pw) ?? 1,
            'effective_date' => $this->effective_date,
            'effective_dates' => CoopEffectiveDate::whereIn('fk_coop', function ($query) {
                $query->select('id')->from('cooperatives')->where('Name', strtoupper($this->cooperative));
            })->orderBy('date', 'DESC')->get(),
            'test' => now()
        ]);
    }

    public function mount()
    {
        $this->effective_date = $this->max_effective_date();
    }

    public function updatedCooperative()
    {
        $this->effective_date = $this->max_effective_date();
    }

    public function max_effective_date()
    {
        return date(
            'm_d_Y',
            strtotime(
                CoopEffectiveDate::whereIn('fk_coop', function ($query) {
                    $query->select('id')->from('cooperatives')->where('Name', strtoupper($this->cooperative));
                })->max('date')
            )
        );
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
                ->category($this->category, $this->state)
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

    protected function get_multiplier($coop, $state, $pw)
    {
        $column = ($coop == 'aepa') ? (($pw) ? 'aepa_pw' : 'aepa_npw') : $coop;
        $multiplier = optional(State::select($column)->find($state))->$column;
        return $multiplier;
    }
}