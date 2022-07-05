@extends('layouts.app')

@section('content')
    <h1>Criar produto</h1>
    <form action="/create_produtcs/{{$produto->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

      <div class="form-group product-image">
        <label for="image">Image</label>
        <input type="file" class="form-control-file" id="image" name ="image"image>
        <img src="/images/{{$produto->image}}" alt="{{$produto->title}}" style="height:250px;width:250px;">
    </div>

  <div class="form-group">
    <label for="name">Nome do produto:</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror"  value="{{ $produto->name }}"  id="name" name ="name" aria-describedby="name" placeholder="Enter name" required>
    @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
    @enderror
  </div>


  <div class="form-group">
    <label for="price">Preço:</label>
    <input type="number" class="form-control @error('price') is-invalid @enderror"  value="{{ $produto->price }}"  name="price" id="price" aria-describedby="price" placeholder="Enter price" required>
    @error('price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="quantity">Quantidade disponivel em estoque:</label>
    <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ $produto->quantity }}"  id="quantity" aria-describedby="quantity" placeholder="Enter quantity" required>
    @error('quantity')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
    @enderror
  </div>

    <div class="form-group">
            <label for="title">Disponivel para venda?</label>
           <select name="available" id="available" class="form-control">
            <option value = "0">Não</option>
            <option value = "1" {{ $produto->available == 1 ? "selected = 'selected'" : "" }}>Sim</option>
        </select>
    </div>

    <div class="form-group">
            <label for="title">Descrição do evento</label>
            <textarea type="text" class="form-control" id="description" name="description" placeholder="Descrição do evento">{{$produto->description}}</textarea>
        </div>





  <button type="submit" class="btn btn-primary">Submit</button>
</form>


@endsection





