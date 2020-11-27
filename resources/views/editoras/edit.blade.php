@extends('layout')
<form action="{{route('editoras.update', ['id'=>$editora->id_editora])}}" method="post">
@csrf
@method('patch')
Nome: (<b sytle="color:red">*</b>) <input type="text" name="nome" value="{{$editora->nome}}"><br><br>
@if($errors->has('nome'))
<b style="color:red">Deverá o Nome entre 3 e 100 carateres</b><br>
@endif

Morada: <input type="text" name="nacionalidade" value="{{$editora->nacionalidade}}"><br><br>
@if($errors->has('morada'))
<b style="color:red">Deverá ter entre 3 e 255 carateres</b><br>
@endif

Observações: <textarea name="observacoes">{{$editora->observacoes}}</textarea><br><br>
@if($errors->has('observacoes'))
<b style="color:red">Deverá ter entre 3 e 255 carateres</b><br>
@endif


<input type="submit" value="enviar">
</form>