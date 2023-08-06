<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pricebook;
use Livewire\WithPagination;

class Pricebooks extends Component
{
    use WithPagination;
    public $cooperative = 0;
    public $search;
    public $perPage = 20;
    public $orderBy = 'Pricebooks.id';
    public $sortBy = 'asc';
    public function render()
    {
        $pricebook = $this->get_pricebook($this->cooperative);
        $materials = Pricebook::select('Pricebooks.*')
            ->join('Material_Unit_Sizes', 'Material_Unit_Sizes.id', '=', 'Pricebooks.fk_unit_size')
            ->join('Material_Categories', 'Material_Categories.id', '=', 'Pricebooks.fk_category')
            ->where($pricebook['pricebook_status_column'], '!=', 'Obsolete')
            ->search(trim($this->search))
            ->orderBy($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        $this->resetPage();
        return view('livewire.pricebooks', [
            'materials' => $materials,
            'discount' => $this->get_discount($this->cooperative),
            'pricebook' => $this->get_pricebook($this->cooperative)
        ]);
    }

    protected function get_discount($coop)
    {
        if ($coop == 1) {
            $discount = .134;
        } else if ($coop == 2) {
            $discount = .133;
        } else if ($coop == 3) {
            $discount = .132;
        } else {
            $discount = 0;
        }
        return number_format(1 - $discount, 3);
    }

    protected function get_pricebook($coop)
    {
        switch ($coop) {
            // AEPA/CMAS/ESCNJ/CES
            case 1:
                $pb['pricebook_column'] = "PB_FY23_3";
                $pb['pricebook_status_column'] = "PB_FY23_3_Status";
                break;
            // EI/IPHEC
            case 2:
                $pb['pricebook_column'] = "PB_FY23_3";
                $pb['pricebook_status_column'] = "PB_FY23_3_Status";
                break;
            // OMNIA
            case 3:
                $pb['pricebook_column'] = "PB_FY24_1";
                $pb['pricebook_status_column'] = "PB_FY24_1_Status";
                break;
            default:
                $pb['pricebook_column'] = "PB_FY24_1";
                $pb['pricebook_status_column'] = "PB_FY24_1_Status";
        }
        return $pb;
    }
}