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
     * Mostra a pagina inicial do software. Observe que exite um try para evitar casos em que
     * não existem produtos cadastrados! Além disso, verificamos se existe alguma busca no request
     * e se existir mostraremos o resultado dela.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
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
        } catch (\Throwable $th) {
            return view('home', ['produtos'=>[], 'search' => []]);
        }

    }




}


