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
     * Mostra a pagina com a tabela de produtos cadastros. Disponivel apenas para administradores.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products_crud.product');
    }

    /**
     * Mostra a pagina de cadastro dos produtos.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products_crud.create');
    }

    /**
     * Usado para cadastrar novos produtos, pegamos a informação da pagina de cadastro e 
     * adicionamos ao banco.
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

    /**
     * Listagem dos produtos cadastrados, usado para alimentar a tabela de produtos!
     *
     * @return \Illuminate\Http\Response
     */
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


    /**
     * Listagem de usuarios cadastrados no sistema, usado para alimentar a tabela de usuarios!
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function userlist()
    {
        $users = User::all();
  
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

    /**
     * Muda uma Role e a Permission de um determinado usuario,
     * se ele tem a role Admin ele muda para a User. Caso contrario, mudará de User
     * para Admin.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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


    /**
     * Mostra um determinado produto na pagina Show!
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Products::where('id', $id)->first();
        return view('show', ['produto'=> $produto]);
    }

    /**
     * Edição de produtos cadastrados no software.
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
     * Update de produtos cadastrados no software!
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
     * Deleta um determinado produto cadastrado no software!
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Products::destroy($id);
    }

    /**
     * Usado para apagar um usuario do sistema, opção 'Delete' na tabela de usuarios.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_user($id)
    {
        User::destroy($id);
    }


    /**
     * Adiciona valores para a relacionamento "pedidos", um usuario e um produto que foi comprado.
     * Vão aparecer na tabela products_user.
     *
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function join(Request $request)
    { 
        $user = Auth()->user();
        $user->pedidos()->attach([
            $request->products_id => ['comprado' => true, 'quantidade_comprada'=> $request->quantidade_comprada],
        ]); 
        
        return redirect('/home');
    }


    /**
     * Mostra os produtos comprados pelo usuario atual.
     *
     * @return \Illuminate\Http\Response
     */
    public function carrinho()
    {
        return view('carrinho', ['produtos'=>Auth()->user()->pedidos]);
    }
}
