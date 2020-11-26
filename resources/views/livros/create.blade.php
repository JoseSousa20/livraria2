
<form action="{{route('livros.store')}}" method="post">
@csrf
Título: <input type="text" name="titulo"><br><br>
Idioma: <input type="text" name="idioma"><br><br>
Total páginas: <input type="text" name="total_paginas"><br><br>
Data Edição: <input type="text" name="data_edicao"><br><br>
ISBN: <input type="text" name="isbn"><br><br>
Observações: <textarea name="observacoes"></textarea><br><br>
Imagem capa: <input type="text" name="imagem_capa"><br><br>
Género: <input type="text" name="id_genero"><br><br>
Autor: <input type="text" name="id_autor"><br><br>
Sinopse: <textarea name="sinopse"></textarea><br><br>
<input type="submit" value="enviar">
</form>