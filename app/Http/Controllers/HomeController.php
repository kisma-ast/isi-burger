<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Burger;

class HomeController extends Controller
{
    public function index()
    {
        $burgers = Burger::latest()->get();
        return view('welcome', compact('burgers'));
    }
}
