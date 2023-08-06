<?php

namespace App\Http\Controllers;

use view;
use App\Models\Pricebook;
use App\Models\Cooperative;
use Illuminate\Http\Request;
use App\Models\MaterialCategory;
use App\Http\Controllers\Controller;

class PricebookController extends Controller
{
    // Show all listings
    public function index()
    {
        return view('references.pricebook');
        // $search_filter = request()->query('search');
        // $cooperative_filter = request()->query('filter-radio');
        // $category_filter = request()->query('filter-checkbox');
        // $discount = ($cooperative_filter) ? $this->get_discount($cooperative_filter) : 0;
        // $pricebook = $this->get_pricebook($cooperative_filter);
        // $materials = Pricebook::query()->with(['MaterialCategories', 'MaterialUnitSizes'])->where($pricebook['pricebook_status_column'], '!=', 'Obsolete')->SearchFilter($search_filter)->CategoryFilter($category_filter)->orderBy("id", "ASC")->paginate(30);
        // $categories = MaterialCategory::get();
        // $cooperatives = Cooperative::get();
        // return view(
        //     'references.pricebook',
        //     [
        //         'search_placeholder' => "Search Pricebook...",
        //         'materials' => $materials,
        //         'discount' => $discount,
        //         'pricebook' => $pricebook,
        //         'cooperatives' => $cooperatives,
        //         'cooperative_filter' => $cooperative_filter,
        //         'categories' => $categories,
        //         'category_filter' => $category_filter
        //     ]
        // );
    }

    protected function get_discount($coop)
    {
        if ($coop == "BOOK") {
            $discount = 0;
        } else if ($coop == "AEPA" || $coop == "CES" || $coop == "ESCNJ" || $coop == "CMAS") {
            $discount = .134;
        } else if ($coop == "E&I" || $coop == "IPHEC") {
            $discount = .133;
        } else if ($coop == "OMNIA") {
            $discount = .132;
        } else if ($coop == "KINETIC") {
            $discount = 0.12;
        } else {
            $discount = 1;
        }
        return $discount;
    }

    protected function get_pricebook($coop)
    {
        switch ($coop) {
            case "AEPA":
                $pb['pricebook_column'] = "PB_FY23_3";
                $pb['pricebook_status_column'] = "PB_FY23_3_Status";
                break;
            case "E&I":
                $pb['pricebook_column'] = "PB_FY23_3";
                $pb['pricebook_status_column'] = "PB_FY23_3_Status";
                break;
            case "OMNIA":
                $pb['pricebook_column'] = "PB_FY23_3";
                $pb['pricebook_status_column'] = "PB_FY23_3_Status";
                break;
            default:
                $pb['pricebook_column'] = "PB_FY24_1";
                $pb['pricebook_status_column'] = "PB_FY24_1_Status";
        }
        return $pb;
    }
}