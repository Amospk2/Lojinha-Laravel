<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $search = request('search');
        if($search)
        {
            $produtos = Products::where([['name', 'like', '%'.$search.'%']])->get();
        }
        else
        {
            $produtos = Products::all();
        }
        return view('home', ['produtos'=>$produtos, 'search' => $search]);

    }




}


