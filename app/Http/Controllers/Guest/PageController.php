<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Mostra la homepage per gli ospiti
    public function index()
    {
        return view('guest.index');
    }
}
