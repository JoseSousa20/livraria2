<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
        if(Gate::allows('admin')){
            return view('generos.create');
        }
        else{
            return redirect()->route('generos.index')
            ->with('msg','Não tem permissão para aceder a área pretendida');
        }
    }

    public function store(Request $req){
        if(Gate::allows('admin')){
            $novoGenero = $req -> validate([
                'designacao'=>['required','min:3', 'max:30'],
                'observacoes'=>['nullable','min:3', 'max:255'],
            ]);
            $genero = Genero::create($novoGenero);

            return redirect()->route('generos.show',[
                'id' => $genero->id_genero
            ]);
        }
        else{
            return redirect()->route('generos.index')
            ->with('msg','Não tem permissão para aceder a área pretendida');
        }
    }


    public function edit(Request $req){
        $editGenero = $req->id;
        $genero=Genero::where('id_genero',$editGenero)->first();
        if(Gate::allows('admin')){
            return view('generos.edit',[
                'generos'=>$genero
            ]);
        }
        else{
            return redirect()->route('generos.index')
            ->with('msg','Não tem permissão para aceder a área pretendida');
        }
    }

    public function update(Request $req){
        $idGenero = $req->id;
        $genero=Genero::where('id_genero',$idGenero)->first();
        if(Gate::allows('admin')){
            $updateGenero = $req -> validate([
                'designacao'=>['required','min:3', 'max:30'],
                'observacoes'=>['nullable','min:3', 'max:255'],
            ]);
            $genero->update($updateGenero);

            return redirect()->route('generos.show',[
                'id' => $genero->id_genero
            ]);
        }
        else{
            return redirect()->route('generos.index')
            ->with('msg','Não tem permissão para aceder a área pretendida');
        }
    }

    public function delete(Request $req){
        $idGenero = $req ->id;
        $genero = Genero::where('id_genero', $idGenero)->first();
        if(Gate::allows('admin')){
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
        else{
            return redirect()->route('generos.index')
            ->with('msg','Não tem permissão para aceder a área pretendida');
        }
    }

    public function destroy(Request $req){
        $idGenero = $req ->id;
        $genero = Genero::findOrfail($idGenero);
        
        $genero->delete();

        return redirect()->route('generos.index')->with('msg','Genero eliminado!');

    }

}
