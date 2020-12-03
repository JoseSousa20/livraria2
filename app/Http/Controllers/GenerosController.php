<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genero;

class GenerosController extends Controller
{
    //
    public function index(){
        //$generos = Genero::all()->sortbydesc('idl');
        $generos= Genero::paginate(4);
        return view('generos.index',[
            'generos'=>$generos
        ]);
    }
    public function show(Request $request){
        $idgenero = $request->id;
        //$genero=Genero::findOrFail($idgenero);
        //$genero=Genero::find($idgenero);
        $genero=Genero::where('id_genero',$idgenero)->with('livros')->first();
        return view('generos.show',[
            'genero'=>$genero
        ]);
    }

    
    public function create(){
        return view('generos.create');
    }

    public function store(Request $req){
        $novoGenero = $req -> validate([
            'designacao'=>['required','min:3', 'max:30'],
            'observacoes'=>['nullable','min:3', 'max:255'],
        ]);
        $genero = Genero::create($novoGenero);

        return redirect()->route('generos.show',[
            'id' => $genero->id_genero
        ]);
    }


    public function edit(Request $req){
        $editGenero = $req->id;
        $genero=Genero::where('id_genero',$editGenero)->first();

        return view('generos.edit',[
            'generos'=>$genero
        ]);
    }

    public function update(Request $req){
        $idGenero = $req->id;
        $genero=Genero::where('id_genero',$idGenero)->first();

        $updateGenero = $req -> validate([
            'designacao'=>['required','min:3', 'max:30'],
            'observacoes'=>['nullable','min:3', 'max:255'],
        ]);
        $genero->update($updateGenero);

        return redirect()->route('generos.show',[
            'id' => $genero->id_genero
        ]);
    }

    public function delete(Request $req){
        $idGenero = $req ->id;
        $genero = Genero::where('id_genero', $idGenero)->first();
        if(is_null($genero)){
            return redirect()->route('generos.index')
            ->with('msg','O genero não existe');
        }
        else
        {
            return view('generos.delete',[
                'generos'=>$genero
            ]);
        }
    }

    public function destroy(Request $req){
        $idGenero = $req ->id;
        $genero = Genero::findOrfail($idGenero);
        
        $genero->delete();

        return redirect()->route('generos.index')->with('msg','Genero eliminado!');

    }

}
