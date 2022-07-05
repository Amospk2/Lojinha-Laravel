@extends('layouts.app')

@section('content')

<div class="search-container">
  <h1>Procurar Produto</h1>
  <form action="/" method="GET">
    <input type="text" class="form-control" id="search" name="search">
  </form>
  
</div>



@if($search)
  <h2>Buscando por "{{$search}}"</h2>

@else
  <h2>Produtos em destaque</h2>

@endif


<div class="row">
  @foreach($produtos as $produto)
  <div class="card" style="width: 15rem; margin-right:10px;">
    <img class="card-img-top" src="/images/{{$produto->image}}" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">{{$produto->name}} - R${{$produto->price}}</h5>
      <p class="card-text">{{$produto->description}}</p>
      <a href="/products/{{$produto->id}}" class="btn btn-primary">Ver produto</a>
    </div>
  </div>
@endforeach
</div>



@if($search && count($produtos) == 0)
    <p>Nenhum produto com nome "{{$search}}" encontrado! <a href="/">Voltar</a></p>
@elseif(count($produtos) == 0)
    <p>Nenhum produto disponivel.</p>
@endif



<link rel="stylesheet" href="css/styleHome.css">

@endsection
