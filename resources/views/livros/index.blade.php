@extends('layout')
@section('titulo-pagina')
Livraria
@endsection
@section('conteudo')
<ul>
{{$livros->render()}}
@foreach($livros as $livro)
<li>
<a href="{{route('livros.show', ['id'=>$livro->id_livro])}}">
    {{$livro->titulo}}
</a>
</li>
@endforeach
<br>
@if(auth()->check())
<a href="{{route('livros.create')}}" class="btn btn-primary">Adicionar Livro</a>
@endif
<br>
<br>
</ul>
@endsection
