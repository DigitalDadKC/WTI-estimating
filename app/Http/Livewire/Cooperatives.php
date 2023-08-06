<?php

namespace App\Http\Livewire;

use App\Models\State;
use Livewire\Component;
use App\Models\Cooperative;
use App\Models\CoopAepaLine;
use App\Models\CoopCategory;
use Livewire\WithPagination;

class Cooperatives extends Component
{
    use WithPagination;
    public $cooperative = 'aepa';
    public $category;
    public $search;
    public $perPage = 20;
    public $state = 8;
    public $pw = 'pw';

    public function render()
    {
        $lines = CoopAepaLine::leftjoin('Unit_Of_Measurements', 'Unit_Of_Measurements.id', '=', 'Coop_Aepa_Lines.fk_UOM')
            ->leftjoin('Coop_Categories', 'Coop_Categories.id', '=', 'Coop_Aepa_Lines.fk_category')
            ->search(trim($this->search))
            ->category($this->category)
            ->paginate($this->perPage);
        $categories = CoopCategory::where('AEPA_order', '!=', null)->orderBy('AEPA_order')->get();
        $state_multiplier = State::where('id', '=', $this->state);
        $this->resetPage();
        return view('livewire.cooperatives', [
            'lines' => $lines,
            'categories' => $categories,
            'states' => State::get(),
            'state' => $state_multiplier
        ]);
        // $pricebook = $this->get_pricebook($this->cooperative);
        // $materials = Pricebook::select('Pricebooks.*')
        //     ->join('Material_Unit_Sizes', 'Material_Unit_Sizes.id', '=', 'Pricebooks.fk_unit_size')
        //     ->join('Material_Categories', 'Material_Categories.id', '=', 'Pricebooks.fk_category')
        //     ->where($pricebook['pricebook_status_column'], '!=', 'Obsolete')
        //     ->search(trim($this->search))
        //     ->orderBy($this->orderBy, $this->sortBy)
        //     ->paginate($this->perPage);
        // $this->resetPage();
        // return view('livewire.cooperatives', [
        //     'materials' => $materials,
        //     'cooperatives' => Cooperative::get(),
        //     'discount' => $this->get_discount($this->cooperative),
        //     'pricebook' => $this->get_pricebook($this->cooperative)
        // ]);
    }

    // protected function get_discount($coop)
    // {
    //     if ($coop == 1) {
    //         $cooperative = .134;
    //     } else if ($coop == 2) {
    //         $cooperative = .133;
    //     } else if ($coop == 3) {
    //         $cooperative = .132;
    //     } else {
    //         $discount = 0;
    //     }
    //     return "coop_lines_" . $cooperative;
    // }

    // protected function get_pricebook($coop)
    // {
    //     switch ($coop) {
    //         // AEPA/CMAS/ESCNJ/CES
    //         case 1:
    //             $pb['pricebook_column'] = "PB_FY23_3";
    //             $pb['pricebook_status_column'] = "PB_FY23_3_Status";
    //             break;
    //         // EI/IPHEC
    //         case 2:
    //             $pb['pricebook_column'] = "PB_FY23_3";
    //             $pb['pricebook_status_column'] = "PB_FY23_3_Status";
    //             break;
    //         // OMNIA
    //         case 3:
    //             $pb['pricebook_column'] = "PB_FY24_1";
    //             $pb['pricebook_status_column'] = "PB_FY24_1_Status";
    //             break;
    //         default:
    //             $pb['pricebook_column'] = "PB_FY24_1";
    //             $pb['pricebook_status_column'] = "PB_FY24_1_Status";
    //     }
    //     return $pb;
    // }
}