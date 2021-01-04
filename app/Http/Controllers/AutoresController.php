<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
        if(Gate::allows('admin')){
            return view('autores.create');
        }
        else{
            return redirect()->route('autores.index')
            ->with('msg','Não tem permissão para aceder a área pretendida');
        }
    }

    public function store(Request $req){
        if(Gate::allows('admin')){
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
        else{
            return redirect()->route('autores.index')
            ->with('msg','Não tem permissão para aceder a área pretendida');
        }
    }

    public function edit(Request $req){
        if(Gate::allows('admin')){
            $editAutor = $req->id;
            $autor=Autor::where('id_autor',$editAutor)->first();

            return view('autores.edit',[
                'autor'=>$autor
            ]);
        }
        else{
            return redirect()->route('autores.index')
            ->with('msg','Não tem permissão para aceder a área pretendida');
        }
    }

    public function update(Request $req){
        $idAutor = $req ->id;
        $autor = Autor::where('id_Autor', $idAutor)->first();
        if(Gate::allows('admin')){
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
        else{
            return redirect()->route('autores.index')
            ->with('msg','Não tem permissão para aceder a área pretendida');
        }
    }
    
    public function delete(Request $req){
        $idAutor = $req ->id;
        $autor = Autor::where('id_autor', $idAutor)->first();
        if(Gate::allows('admin')){
            if(is_null($autor)){
                return redirect()->route('autores.index')
                ->with('msg','O autor não existe');
            }
            else
            {
                return view('autores.delete',[
                    'autor'=>$autor
                ]);
            }
        }
        else{
            return redirect()->route('autores.index')
            ->with('msg','Não tem permissão para aceder a área pretendida');
        }
    }

    public function destroy(Request $req){
        $idAutor = $req ->id;
        $autor = Autor::findOrfail($idAutor);
        
        $autor->delete();

        return redirect()->route('autores.index')->with('msg','Autor eliminado!');

    }
    
}
