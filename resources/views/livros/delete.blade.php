@extends('layout')
<h2>Deseja eliminar o livro</h2>
<h2>{{$livro->titulo}}</h2>
<form action="{{route('livros.destroy', ['id'=>$livro->id_livro])}}" method="post">
    @csrf
    @method('delete')
    <input type="hidden" value="{{$livro->id_livro}}">
    <input type="submit" value="Eliminar">
</form>