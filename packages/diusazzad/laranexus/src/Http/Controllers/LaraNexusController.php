<?php

namespace Diusazzad\LaraNexus\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;

class LaraNexusController extends Controller
{
    /**
     * Display the LaraNexus dashboard.
     */
    public function index(): View
    {
        return view('laranexus::dashboard');
    }
}
