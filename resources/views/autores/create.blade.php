@extends('layout')
<form action="{{route('autores.store')}}" method="post">
@csrf
Nome: (<b sytle="color:red">*</b>) <input type="text" name="nome" value="{{old('nome')}}"><br><br>
@if($errors->has('nome'))
<b style="color:red">Deverá o Nome entre 3 e 100 carateres</b><br>
@endif

Nacionalidade: <input type="text" name="nacionalidade" value="{{old('nacionalidade')}}"><br><br>
@if($errors->has('nacionalidade'))
<b style="color:red">Deverá ter entre 3 e 20 carateres</b><br>
@endif

Data Nascimento: <input type="date" name="data_nascimento" value="{{old('data_nascimento')}}"><br><br>
@if($errors->has('data_nascimento'))
<b style="color:red">Formato de data incorreto(DD-MM-AAAA)</b><br><br>
@endif

Fotografia: <input type="text" name="fotografia" value="{{old('fotografia')}}"><br><br>
@if($errors->has('fotografia'))
<b style="color:red">Fotografia inválida</b><br>
@endif

<input type="submit" value="enviar">
</form>