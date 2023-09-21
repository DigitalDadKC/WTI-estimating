<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pricebook;
use Livewire\WithPagination;
use App\Models\MaterialCategory;

class Pricebooks extends Component
{
    use WithPagination;
    public Pricebook $selectedMaterial;
    public $cooperative = 0;
    public $category;
    public $search;
    public $perPage = 20;
    public $orderBy = 'pricebooks.id';
    public $sortBy = 'asc';

    public function render()
    {
        $pricebook = $this->get_pricebook($this->cooperative);
        $materials = Pricebook::select('pricebooks.*')
            ->join('material_unit_sizes', 'material_unit_sizes.id', '=', 'pricebooks.fk_unit_size')
            ->join('material_categories', 'material_categories.id', '=', 'pricebooks.fk_category')
            ->where($pricebook['pricebook_status_column'], '!=', 'Obsolete')
            ->search(trim($this->search))
            ->category($this->category)
            ->orderBy($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        return view('livewire.pricebooks', [
            'materials' => $materials,
            'categories' => MaterialCategory::orderBy('Name')->get(),
            'discount' => $this->get_discount($this->cooperative),
            'pricebook' => $this->get_pricebook($this->cooperative)
        ]);
    }

    public function viewMaterial(Pricebook $pricebook)
    {
        $this->selectedMaterial = $pricebook;
        $this->selectedMaterial->Name = addslashes($pricebook->Name);
        $this->dispatch('open-modal', 'unit-conversion');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedCategory()
    {
        $this->resetPage();
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
                $pb['pricebook_column'] = "PB_FY24_1";
                $pb['pricebook_status_column'] = "PB_FY24_1_Status";
                break;
            // EI/IPHEC
            case 2:
                $pb['pricebook_column'] = "PB_FY24_1";
                $pb['pricebook_status_column'] = "PB_FY24_1_Status";
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