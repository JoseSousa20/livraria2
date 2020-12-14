<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $primaryKey="id_comentario";
    protected $table="comentarios";

    protected $fillable = [
        'id_comentario',
        'id_livro',
        'id_user',
        'comentario'
    ];


    public function livro(){
        return $this->belongsTo(
            'App\Model\Livro',
            'id_livro'
        );
    }
}
