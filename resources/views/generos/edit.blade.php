@extends('layout')
<form action="{{route('generos.store')}}" method="post">
@csrf
@method('patch')
Designação: (<b sytle="color:red">*</b>) <input type="text" name="designacao" value="{{$generos->designacao}}"><br><br>
@if($errors->has('designacao'))
<b style="color:red">Deverá ter entre 3 e 30 carateres</b><br>
@endif

Observações: <textarea name="observacoes">{{$generos->observacoes}}</textarea><br><br>
@if($errors->has('observacoes'))
<b style="color:red">Deverá ter entre 3 e 255 carateres</b><br>
@endif

<input type="submit" value="enviar">
</form>