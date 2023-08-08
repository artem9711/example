<?php

namespace App\Http\Controllers\Personal\Main;

use App\Http\Controllers\Controller;

class MainPersonalController extends Controller
{
    public function index()
    {
        return view('personal.main.index');
    }

    public function comment()
    {
        return view('personal.comment.index');
    }
}
