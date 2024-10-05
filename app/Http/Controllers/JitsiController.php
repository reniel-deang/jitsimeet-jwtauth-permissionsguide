<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JitsiController extends Controller
{
    public function showForm()
    {
        return view('generate_token');
    }
}