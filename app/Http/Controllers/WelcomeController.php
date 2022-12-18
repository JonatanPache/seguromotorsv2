<?php

namespace App\Http\Controllers;

use App\Models\Seguro;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $skills=Seguro::all();
        $projects=Vehiculo::all();
        return view('welcome',compact('skills','projects'));
    }
}
