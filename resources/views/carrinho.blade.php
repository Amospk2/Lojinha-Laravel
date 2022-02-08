@extends('layouts.app')

@section('content')

@if(count($produtos) <= 0)
    <h1>Nothing Here till</h1>
@endif


@foreach($produtos as $produto)

<div style="display:flex; flex:1 1 auto; margin-bottom:10px;">
<img class="card-img-top" style="height:230px; width:230px;" src="/images/{{$produto->image}}" alt="Card image cap">
<div class="card w-75">
  
  <div class="card-body">
    <div class="{{$produto->pivot->comprado == FALSE ? 'alert alert-primary d-flex align-items-center' : 'alert alert-success d-flex align-items-center'}}" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
        <div>
          {{$produto->pivot->comprado == FALSE ? "Status: Compra em andamento" : "Compra Finalizada"}}
        </div>
    </div>

    <h5 class="card-title">{{$produto->name}}</h5>
    <p class="card-text">{{$produto->description}}</p>
      
  </div>
</div>
</div>

@endforeach



@endsection
