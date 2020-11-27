@extends('layout')
@section('titulo-pagina')
Livraria
@endsection
@section('conteudo')
<ul>
{{$autores->render()}}
@foreach($autores as $autor)
<li>
<a href="{{route('autores.show', ['id'=>$autor->id_autor])}}">
    {{$autor->nome}}
</a></li>
@endforeach
<br>
<a href="{{route('autores.create')}}" class="btn btn-primary">Adicionar Autor</a>
</ul>
@endsection