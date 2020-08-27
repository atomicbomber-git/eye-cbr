<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gejala;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Gejala::query()
            ->select('id', 'description')
            ->get();

        return view('feature.index', compact('features'));
    }
}
