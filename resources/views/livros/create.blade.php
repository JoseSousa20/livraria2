@extends('layout')
<form action="{{route('livros.store')}}" method="post">
@csrf
Título: (<b sytle="color:red">*</b>) <input type="text" name="titulo" value="{{old('titulo')}}"><br><br>
@if($errors->has('titulo'))
<b>Deverá ter entre 3 e 100 carateres</b><br>
@endif

Idioma: (<b sytle="color:red">*</b>) <input type="text" name="idioma" value="{{old('idioma')}}"><br><br>
@if($errors->has('idioma'))
<b style="color:red">Deverá ter entre 3 e 10 carateres</b><br>
@endif

Total páginas: <input type="text" name="total_paginas" value="{{old('total_paginas')}}"><br><br>
@if($errors->has('total_paginas'))
<b style="color:red">Deverá ter mais de uma 1 página</b><br>
@endif

Data Edição: <input type="date" name="data_edicao" value="{{old('data_edicao')}}"><br><br>
@if($errors->has('data_edicao'))
<b style="color:red">Formato de data incorreto(DD-MM-AAAA)</b><br>
@endif

ISBN: (<b sytle="color:red">*</b>) <input type="text" name="isbn" value="{{old('isbn')}}"><br><br>
@if($errors->has('isbn'))
<b style="color:red">Deverá indicar um ISBN correto (13 carateres)</b><br>
@endif

Observações: <textarea name="observacoes">{{old('observacoes')}}</textarea><br><br>
@if($errors->has('observacoes'))
<b style="color:red">Deverá ter entre 3 e 255 carateres</b><br>
@endif

Imagem capa: <input type="text" name="imagem_capa" value="{{old('imagem_capa')}}"><br><br>
@if($errors->has('imagem_capa'))
<b style="color:red">Imagem inválida</b><br>
@endif


Genero:
<select name="id_genero">
@foreach ($generos as $genero)
    <option value="{{$genero->id_genero}}">{{$genero->designacao}}</option>
@endforeach
</select>
<br>
<br>
@if($errors->has('id_genero'))
<b style="color:red">Id Género tem de ser um número</b><br>
@endif

Autor(es):
<br>
<select name="id_autor[]" multiple="multiple">
    @foreach ($autores as $autor)
        <option value="{{$autor->id_autor}}">{{$autor->nome}}</option>
    @endforeach
</select>
<br>
<br>
@if($errors->has('id_autor'))
<b style="color:red">Id Autor tem de ser um número</b><br>
@endif

Editora(s):
<br>
<select name="id_editora[]" multiple="multiple">
    @foreach ($editoras as $editora)
        <option value="{{$editora->id_editora}}">{{$editora->nome}}</option>
    @endforeach
</select>
<br>
<br>
@if($errors->has('id_editora'))
<b style="color:red">Id Editora tem de ser um número</b><br>
@endif


Sinopse: <textarea name="sinopse">{{old('sinopse')}}</textarea><br><br>
@if($errors->has('sinopse'))
<b style="color:red">Deverá ter entre 3 e 255 carateres</b><br>
@endif

<input type="submit" value="enviar">
</form>