@extends('layout')
<form action="{{route('autores.update', ['id'=>$autor->id_autor])}}" method="post">
@csrf
@method('patch')

Nome: (<b sytle="color:red">*</b>) <input type="text" name="nome" value="{{$autor->nome}}"><br><br>
@if($errors->has('nome'))
<b style="color:red">Deverá o Nome entre 3 e 100 carateres</b><br>
@endif

Nacionalidade: <input type="text" name="nacionalidade" value="{{$autor->nacionalidade}}"><br><br>
@if($errors->has('nacionalidade'))
<b style="color:red">Deverá ter entre 3 e 20 carateres</b><br>
@endif

Data Nascimento: <input type="date" name="data_nascimento" value="{{$autor->data_nascimento}}"><br><br>
@if($errors->has('data_nascimento'))
<b style="color:red">Formato de data incorreto(DD-MM-AAAA)</b><br><br>
@endif

Fotografia: <input type="text" name="fotografia" value="{{$autor->fotografia}}"><br><br>
@if($errors->has('fotografia'))
<b style="color:red">Fotografia inválida</b><br>
@endif

<input type="submit" value="enviar">
</form>