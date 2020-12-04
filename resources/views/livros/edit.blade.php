@extends('layout')
<form action="{{route('livros.update', ['id'=>$livro->id_livro])}}" method="post">
@csrf
@method('patch')

Título: (<b sytle="color:red">*</b>) <input type="text" name="titulo" value="{{$livro->titulo}}"><br><br>
@if($errors->has('titulo'))
<b>Deverá ter entre 3 e 100 carateres</b><br>
@endif

Idioma: (<b sytle="color:red">*</b>) <input type="text" name="idioma" value="{{$livro->idioma}}"><br><br>
@if($errors->has('idioma'))
<b style="color:red">Deverá ter entre 3 e 10 carateres</b><br>
@endif

Total páginas: <input type="text" name="total_paginas" value="{{$livro->total_paginas}}"><br><br>
@if($errors->has('total_paginas'))
<b style="color:red">Deverá ter mais de uma 1 página</b><br>
@endif

Data Edição: <input type="date" name="data_edicao" value="{{$livro->data_edicao}}"><br><br>
@if($errors->has('data_edicao'))
<b style="color:red">Formato de data incorreto(DD-MM-AAAA)</b><br>
@endif

ISBN: (<b sytle="color:red">*</b>) <input type="text" name="isbn" value="{{$livro->isbn}}"><br><br>
@if($errors->has('isbn'))
<b style="color:red">Deverá indicar um ISBN correto (13 carateres)</b><br>
@endif

Observações: <textarea name="observacoes">{{$livro->observacoes}}</textarea><br><br>
@if($errors->has('observacoes'))
<b style="color:red">Deverá ter entre 3 e 255 carateres</b><br>
@endif

Imagem capa: <input type="text" name="imagem_capa" value="{{$livro->imagem_capa}}"><br><br>
@if($errors->has('imagem_capa'))
<b style="color:red">Imagem inválida</b><br>
@endif

Genero:
<select name="id_genero">
@foreach ($generos as $genero)
    <option value="{{$genero->id_genero}}"
        @if ($genero->id_genero==$livro->id_genero)selected 
        @endif
    >{{$genero->designacao}}</option>
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
        <option value="{{$autor->id_autor}}"
        @if(in_array($autor->id_autor, $autoresLivro))selected @endif
        >{{$autor->nome}}</option>
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
        <option value="{{$editora->id_editora}}"
        @if(in_array($editora->id_editora, $editorasLivro))selected @endif
        >{{$editora->nome}}</option>
    @endforeach
</select>
<br>
<br>
@if($errors->has('id_editora'))
<b style="color:red">Id Editora tem de ser um número</b><br>
@endif

Sinopse: <textarea name="sinopse">{{$livro->sinopse}}</textarea><br><br>
@if($errors->has('sinopse'))
<b style="color:red">Deverá ter entre 3 e 255 carateres</b><br>
@endif

<input type="submit" value="enviar">
</form>