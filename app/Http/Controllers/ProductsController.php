<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use Redirect;
use DataTables;
use App\User;
use Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products_crud.product');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products_crud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product = New Products();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->shelf_life = $request->shelf_life;
        $product->description = $request->description;
        $product->available = $request->available;
        
        if($request->hasFile('image') && $request->file('image')->isValid())
        {
            $RI = $request->image;

            $extension = $RI->extension();

            $IName = md5($RI->getClientOriginalName() . strtotime("now") . "." . $extension);
            
            $request->image->move(public_path('images'), $IName);
        
            $product->image = $IName;
        
        }
        
        $product->user_id = Auth()->user()->id;


        $product->save();

        return redirect('/home');
    }

    public function list()
    {
        
        $products = Products::get();

        return Datatables::of($products)->editColumn('opcoes', function($products){
            return '
            <td class="project-actions text-right">
            
            <a class="view btn btn-primary btn-sm" 

            href="/products/'.$products->id.'">
                    View
                </a>

                <a class="btn btn-info btn-sm change" href="/create_produtcs/'.$products->id.'/edit">
                    Edit
                </a>

                <button  class="delete btn btn-danger btn-sm" data-id="'.$products->id.'">
                    Delete
                </button>
                
            </td>
            ';
        })->escapeColumns([0])->make(true);

    }


    public function userlist()
    {
        $users = User::get();
        
        

        


        return Datatables::of($users)->editColumn('opcoes', function($users){


            return '
            <td class="project-actions text-right">

            
                <a href="/manage_users/change_role_permission/'.$users->id.'" class="btn btn-info btn-sm change" >
                    Change Role:'.$users->permissions[0]->name.'
                </a>


                <button class="delete-user btn btn-danger btn-sm" data-id="'.$users->id.'">
                    Delete
                </button>
                
            </td>
            ';
        })->escapeColumns([0])->make(true);
    }

    public function change_role_permission($id)
    {
        $user = User::find($id);
        if($user->permissions[0]->name == 'Admin')
        {
            $user->permissions()->detach([1]);
            $user->roles()->detach([1]);

            $user->permissions()->attach([2]);
            $user->roles()->attach([2]);


        }
        else
        {
            $user->permissions()->detach([2]);
            $user->roles()->detach([2]);

            $user->permissions()->attach([1]);
            $user->roles()->attach([1]);
        }
        return back()->withInput();
    }

    public function delete_user($id)
    {
        User::destroy($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Products::where('id', $id)->get();
        return view('show', ['produto'=> $produto[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Products::find($id);
        return view('products_crud.edit', compact('produto'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Products::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->shelf_life = $request->shelf_life;
        $product->description = $request->description;
        $product->available = $request->available;
        
        if($request->hasFile('image') && $request->file('image')->isValid())
        {
            $RI = $request->image;

            $extension = $RI->extension();

            $IName = md5($RI->getClientOriginalName() . strtotime("now") . "." . $extension);
            
            $request->image->move(public_path('images'), $IName);
        
            $product->image = $IName;
        
        }


        $product->save();

        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Products::destroy($id);
    }

    public function join(Request $request)
    {   
        $user = Auth()->user();
        $user->pedidos()->attach([
            $request->products_id => ['comprado' => true, 'quantidade_comprada'=> $request->quantidade_comprada],
        ]); 
        
        return redirect('/home');
    }
}
