<?php

namespace emutoday\Http\Controllers;

use Illuminate\Http\Request;

use emutoday\Http\Requests;

use emutoday\Story;

class MainController extends Controller
{
    public function index(Story $storys)
    {
        $storys = $storys->get();

        return view('layouts.index', compact('storys'));

    }
}
