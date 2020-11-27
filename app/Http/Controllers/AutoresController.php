<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;

class AutoresController extends Controller
{
    //
    public function index(){
        //$autores = Autor::all()->sortbydesc('idl');
        $autores= Autor::paginate(4);
        return view('autores.index',[
            'autores'=>$autores
        ]);
    }
    public function show(Request $request){
        $idAutores = $request->id;
        //$autores=Autor::findOrFail($idAutores);
        //$autores=Autor::find($idAutores);
        $autores=Autor::where('id_autor',$idAutores)->with('livros')->first();
        return view('autores.show',[
            'autores'=>$autores
        ]);
    }

    public function create(){
        return view('autores.create');
    }

    public function store(Request $req){
        $novoAutor = $req -> validate([
            'nome'=>['required','min:3', 'max:100'],
            'nacionalidade'=>['nullable','min:3', 'max:10'],
            'data_nascimento'=>['nullable','date'],
            'fotografia'=>['nullable']
        ]);
        $autor = Autor::create($novoAutor);

        return redirect()->route('autores.show',[
            'id' => $autor->id_autor
        ]);
    }

    public function edit(Request $req){
        $editAutor = $req->id;
        $autor=Autor::where('id_autor',$editAutor)->first();

        return view('autores.edit',[
            'autor'=>$autor
        ]);
    }

    public function update(Request $req){
        $idAutor = $req ->id;
        $autor = Autor::where('id_Autor', $idAutor)->first();

        $updateAutor = $req -> validate([
            'nome'=>['required','min:3', 'max:100'],
            'nacionalidade'=>['nullable','min:3', 'max:10'],
            'data_nascimento'=>['nullable','date'],
            'fotografia'=>['nullable']
        ]);
        $autor->update($updateAutor);

        return redirect()->route('autores.show',[
            'id' => $autor->id_autor
        ]);
    }
    
    
}
