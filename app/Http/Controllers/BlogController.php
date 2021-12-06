<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Return welcome blade view
     *
     * @return view
     */
    public function index()
    {
        return view('welcome');
    }
}
