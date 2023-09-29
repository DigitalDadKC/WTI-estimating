<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pricebook;
use Livewire\WithPagination;
use App\Models\MaterialCategory;
use App\Models\PricebookEffectiveDate;

class Pricebooks extends Component
{
    use WithPagination;
    public Pricebook $selectedMaterial;
    public $cooperative = NULL;
    public $category;
    public $search;
    public $perPage = 20;
    public $orderBy = 'pricebooks.id';
    public $sortBy = 'asc';
    public $effective_date_id;
    public $effective_date = '2023-06-01';
    public $effective_dates;


    public function mount()
    {
        $this->effective_date = PricebookEffectiveDate::whereNull('fk_coop')->max('date');
        $this->effective_dates = PricebookEffectiveDate::whereNull('fk_coop')->orderBy('date', 'DESC')->get();
    }
    public function render()
    {
        $pricebook = $this->get_pricebook($this->cooperative, $this->effective_date);
        $coop = ($this->cooperative == '') ? NULL : $this->cooperative;
        $materials = Pricebook::select('pricebooks.*')
            ->join('material_unit_sizes', 'material_unit_sizes.id', '=', 'pricebooks.fk_unit_size')
            ->join('material_categories', 'material_categories.id', '=', 'pricebooks.fk_category')
            ->join('material_statuses', 'material_statuses.id', '=', 'pricebooks.PB_FY24_1_Status_2')
            ->where($pricebook['pricebook_status_column'], '!=', 'Obsolete')
            ->search(trim($this->search))
            ->category($this->category)
            ->orderBy($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        $effective_dates = ($coop !== NULL) ? PricebookEffectiveDate::whereIn('fk_coop', function ($query) {
            $query->select('id')->from('cooperatives')->where('Name', strtoupper($this->cooperative));
        })->get() : PricebookEffectiveDate::whereNull('fk_coop')->get();
        return view('livewire.pricebooks', [
            'materials' => $materials,
            'cooperative' => $coop,
            'categories' => MaterialCategory::orderBy('Name')->get(),
            'discount' => $this->get_discount($this->cooperative),
            'pricebook' => $this->get_pricebook($this->cooperative, $this->effective_date),
            'effective_date' => $this->effective_date,
            'effective_dates' => $effective_dates
        ]);
    }

    public function max_effective_date()
    {
        $this->cooperative = ($this->cooperative == 'book') ? NULL : $this->cooperative;
        return $this->effective_date = ($this->effective_date) ? PricebookEffectiveDate::whereIn('fk_coop', function ($query) {
            $query->select('id')->from('cooperatives')->where('Name', strtoupper($this->cooperative));
        })->max('date') : PricebookEffectiveDate::whereNull('fk_coop')->max('date');
    }

    public function viewMaterial(Pricebook $pricebook)
    {
        $this->selectedMaterial = $pricebook;
        $this->selectedMaterial->Name = addslashes($pricebook->Name);
        $this->dispatch('open-modal', 'unit-conversion');
    }

    public function updatedCooperative($value)
    {
        $this->effective_dates = ($value !== 'book') ? PricebookEffectiveDate::where('fk_coop', function ($query) use ($value) {
            $query->select('id')->from('cooperatives')->where('Name', strtoupper($value));
        })->orderBy('date', 'DESC')->get() : PricebookEffectiveDate::whereNull('fk_coop')->get();
        $this->effective_date = ($value !== 'book') ? PricebookEffectiveDate::where('fk_coop', function ($query) use ($value) {
            $query->select('id')->from('cooperatives')->where('Name', strtoupper($value));
        })->max('date') : PricebookEffectiveDate::whereNull('fk_coop')->max('date');
        $this->effective_date_id = ($value !== 'book') ? PricebookEffectiveDate::select('id')->where('fk_coop', function ($query) use ($value) {
            $query->select('id')->from('cooperatives')->where('Name', strtoupper($value));
        })->max('date') : PricebookEffectiveDate::whereNull('fk_coop')->max('date');
        $this->category = '';
        $this->search = '';
        $this->orderBy = 'pricebooks.id';
        $this->sortBy = 'asc';
    }

    public function updatedEffectiveDateId($date_id)
    {
        $this->effective_date = PricebookEffectiveDate::where('id', '=', $date_id)->value('date');
        $this->resetPage();
    }
    public function updatedEffectiveDate()
    {
        $this->effective_date = date('Y-m-d', $this->effective_date);
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
        if ($coop == 'aepa') {
            $discount = .134;
        } else if ($coop == 'ei') {
            $discount = .133;
        } else if ($coop == 'omnia') {
            $discount = .132;
        } else {
            $discount = 0;
        }
        return number_format(1 - $discount, 3);
    }

    protected function get_pricebook($coop, $date)
    {
        switch ($coop) {
            // AEPA/CMAS/ESCNJ/CES
            case 'aepa':
                if ($date == '2023-08-15') {
                    $pb['pricebook_column'] = "PB_FY24_1";
                    $pb['pricebook_status_column'] = "PB_FY24_1_Status";
                } else if ($date == '2023-01-01') {
                    $pb['pricebook_column'] = "PB_FY23_3";
                    $pb['pricebook_status_column'] = "PB_FY23_3_Status";
                }
                break;
            // EI/IPHEC
            case 'ei':
                if ($date == '2023-08-15') {
                    $pb['pricebook_column'] = "PB_FY24_1";
                    $pb['pricebook_status_column'] = "PB_FY24_1_Status";
                } else if ($date == '2023-01-01') {
                    $pb['pricebook_column'] = "PB_FY23_3";
                    $pb['pricebook_status_column'] = "PB_FY23_3_Status";
                }
                break;
            // OMNIA
            case 'omnia':
                if ($date == '2023-08-01') {
                    $pb['pricebook_column'] = "PB_FY24_1";
                    $pb['pricebook_status_column'] = "PB_FY24_1_Status";
                } else if ($date == '2023-01-01') {
                    $pb['pricebook_column'] = "PB_FY23_3";
                    $pb['pricebook_status_column'] = "PB_FY23_3_Status";
                }
            default:
                if ($date == '2023-06-01') {
                    $pb['pricebook_column'] = "PB_FY24_1";
                    $pb['pricebook_status_column'] = "PB_FY24_1_Status";
                } else if ($date == '2023-03-01') {
                    $pb['pricebook_column'] = "PB_FY23_3";
                    $pb['pricebook_status_column'] = "PB_FY23_3_Status";
                }
        }
        return $pb;
    }
}