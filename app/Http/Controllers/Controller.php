<?php

namespace App\Http\Controllers;

use App\Models\Categorie;

abstract class Controller
{
    public function __construct()
    {
        view()->share('categories', Categorie::all());
    }
}
