<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index(Request $request) {


        return view('clients.landing-page');
    }
}
