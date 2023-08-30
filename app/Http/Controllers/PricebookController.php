<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PricebookController extends Controller
{
    public function index()
    {
        return view('references.pricebook');
    }
}