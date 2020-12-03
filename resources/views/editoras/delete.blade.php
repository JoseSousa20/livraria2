@extends('layout')
<h2>Deseja eliminar a Editora</h2>
<h2>{{$editoras->nome}}</h2>
<form action="{{route('editoras.destroy', ['id'=>$editoras->id_editora])}}" method="post">
    @csrf
    @method('delete')
    <input type="hidden" value="{{$editoras->id_editora}}">
    <input type="submit" value="Eliminar">
</form>