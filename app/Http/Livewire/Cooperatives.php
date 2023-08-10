<?php

namespace App\Http\Livewire;

use App\Models\State;
use Livewire\Component;
use App\Models\CoopEiLine;
use App\Models\Cooperative;
use App\Models\CoopAepaLine;
use App\Models\CoopCategory;
use Livewire\WithPagination;
use App\Models\CoopOmniaLine;

class Cooperatives extends Component
{
    use WithPagination;
    public $cooperative = 'aepa';
    public $category;
    public $search;
    public $perPage = 20;
    public $state;
    public $pw = 'pw';
    public $linebook;

    public function render()
    {
        $lines = $this->get_cooperative_lines($this->cooperative);
        $categories = CoopCategory::where('AEPA_order', '!=', null)->orderBy('AEPA_order')->get();
        $multiplier = $this->get_multiplier($this->cooperative, $this->state, $this->pw) ?? 1;
        $line_version = $this->linebook ?? '01_01_2023';
        $this->resetPage();
        return view('livewire.cooperatives', [
            'lines' => $lines,
            'categories' => $categories,
            'states' => State::orderBy('State')->get(),
            'state_multipliers' => State::find($this->state),
            'multiplier' => $multiplier,
            'line_version' => $line_version
        ]);
    }

    protected function get_cooperative_lines($coop)
    {
        if ($coop == 'aepa') {
            $query = CoopAepaLine::leftjoin('Unit_Of_Measurements', 'Unit_Of_Measurements.id', '=', 'Coop_Aepa_Lines.fk_UOM')
                ->leftjoin('Coop_Categories', 'Coop_Categories.id', '=', 'Coop_Aepa_Lines.fk_category')
                ->search(trim($this->search))
                ->category($this->category)
                ->paginate($this->perPage);
        } else if ($coop == 'ei') {
            $query = CoopEiLine::leftjoin('Unit_Of_Measurements', 'Unit_Of_Measurements.id', '=', 'Coop_Ei_Lines.fk_UOM')
                ->leftjoin('Coop_Categories', 'Coop_Categories.id', '=', 'Coop_Ei_Lines.fk_category')
                ->search(trim($this->search))
                ->category($this->category)
                ->paginate($this->perPage);
        } else if ($coop == 'omnia') {
            $query = CoopOmniaLine::leftjoin('Unit_Of_Measurements', 'Unit_Of_Measurements.id', '=', 'Coop_Omnia_Lines.fk_UOM')
                ->leftjoin('Coop_Categories', 'Coop_Categories.id', '=', 'Coop_Omnia_Lines.fk_category')
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