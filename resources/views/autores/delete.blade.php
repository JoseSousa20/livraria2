@extends('layout')
<h2>Deseja eliminar o Autor</h2>
<h2>{{$autor->Autor}}</h2>
<form action="{{route('autores.destroy', ['id'=>$autor->id_autor])}}" method="post">
    @csrf
    @method('delete')
    <input type="hidden" value="{{$autor->id_autor}}">
    <input type="submit" value="Eliminar">
</form>