<?php

namespace App\Http\Controllers;

use App\Models\ProcessStep;

class ProcessController extends Controller
{
    public function index()
    {
        $steps = ProcessStep::active()->ordered()->get();
        return view('process.index', compact('steps'));
    }
}
