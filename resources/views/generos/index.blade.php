@extends('layout')
@section('titulo-pagina')
Livraria
@endsection
@section('conteudo')
<ul>
{{$generos->render()}}
@foreach($generos as $genero)
<li>
<a href="{{route('generos.show', ['id'=>$genero->id_genero])}}">
    {{$genero->designacao}}
</a></li>
@endforeach
</ul>
@endsection