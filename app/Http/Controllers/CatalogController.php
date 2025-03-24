<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class CatalogController extends Controller
{
    public function index()
    {
        $sections = Section::with(['topics' => function($query) {
            $query->orderBy('order');
        }])->orderBy('order')->get();

        return view('catalog', compact('sections'));
    }
}
