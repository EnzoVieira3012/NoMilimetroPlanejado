<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Exibe a página da Dashboard.
     */
    public function index()
    {
        // Retorna a view da dashboard (página em branco por enquanto)
        return view('pages.dashboard');
    }
}
