<?php

namespace App\Controllers;
use App\Models\Property\Property;

class Home extends BaseController
{
    public function index()
    {

        $props = new Property();
        $allProps = $props->findAll();
        return view('home', compact('allProps'));
    }

    public function about()
    {
        return view('pages/about');
    }

    public function contact()
    {
        return view('pages/contact');
    }
}
