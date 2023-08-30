<?php

namespace App\Http\Livewire;

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
    public $linebook = '01_01_2023';

    public function render()
    {
        $lines = $this->get_cooperative_lines($this->cooperative, $this->state);
        $categories = CoopCategory::where(strtoupper($this->cooperative) . "_order", '!=', null)->cafilter($this->state)->orderBy('AEPA_order')->get();
        $multiplier = $this->get_multiplier($this->cooperative, $this->state, $this->pw) ?? 1;
        $line_version = ($this->cooperative == 'ei') ? '08_15_2023' : '01_01_2023';
        $test = State::where(($this->cooperative == 'aepa') ? 'aepa_npw' : $this->cooperative) ? $this->cooperative : 'not an idiot';
        return view('livewire.cooperatives', [
            'lines' => $lines,
            'categories' => $categories,
            'states' => State::where(($this->cooperative == 'aepa') ? 'aepa_npw' : $this->cooperative, '!=', null)->orderBy('State')->get(),
            'state_multipliers' => State::find($this->state),
            'multiplier' => $multiplier,
            'line_version' => $line_version,
            'test' => $test
        ]);
    }

    public function updatedSearch()
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