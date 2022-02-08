@extends('layouts.app')

@section('content')



<div class="col-md-10 offset-md-1">
    <div class="row">
        <div id="image-cotnainer" class="col-md-6">
            <img src="/images/{{$produto->image}}" alt="{{$produto->name}}" class="img-fluid">
        </div>

        <div class="col-md-6">
            <h2>{{$produto->name}} Por R${{$produto->price}}</h2> 
            <p {{$comprado = FALSE}}>{{$produto->description}}</p>

            @if(@auth()->check())
            @foreach(Auth()->user()->pedidos as $produtos_pedidos)
            
                @if($produtos_pedidos->pivot->products_id == $produto->id and $produtos_pedidos->pivot->comprado == TRUE)
                    <p class="already-joined-msg" {{$comprado = TRUE}}> Produto Comprado, veja seu carrinho.</p>
                    @break
                @endif

            @endforeach

            @if($comprado == FALSE)
            <form action="/products_carrinho/join" method="post">
                    @csrf
                    
                    <label for="quantity">Quantidade:</label>
                    <div class="form-group mb-2">
                        <input type="number" class="form-control" id="quantidade_comprada" name="quantidade_comprada" value = 1 min=1 max={{$produto->quantity}}>
                    </div>

                    <input id="products_id" name="products_id" value="{{$produto->id}}" style="display:none;"></input>

                    <a href="/products_carrinho/join" 
                    class = "btn btn-primary" 
                    id="event-submit"
                    onClick="event.preventDefault();
                    this.closest('form').submit();"
                    >Realizar Compra</a>
            </form>
            @endif

            @else
            <a href="/login" 
                    class = "btn btn-primary" 
                    >Realizar Compra</a>
            @endif



            

        </div>

    
    </div>



</div>
@endsection










