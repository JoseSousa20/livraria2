<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Auth;
use App\Models\Livro;
use App\Models\Genero;
use App\Models\Autor;
use App\Models\Editora;

class LivrosController extends Controller
{
    //
    public function index(){
        //$livros = Livro::all()->sortbydesc('idl');
        $livros= Livro::paginate(4);
        return view('livros.index',[
            'livros'=>$livros
        ]);
    }
    public function show(Request $request){
        $idLivro = $request->id;
        //$livro=Livro::findOrFail($idLivro);
        //$livro=Livro::find($idLivro);
        $livro=Livro::where('id_livro',$idLivro)->with(['genero','autores','editoras','user','comentario'])->first();
        return view('livros.show',[
            'livro'=>$livro
        ]);
    }

    public function create(){
        $generos = Genero::all();
        $autores = Autor::all();
        $editoras = Editora::all();
        return view('livros.create',[
            'generos'=>$generos,
            'autores'=>$autores,
            'editoras'=>$editoras
        ]);
    }

    public function store(Request $req){
            $novoLivro = $req -> validate([
                'titulo'=>['required','min:3', 'max:100'],
                'idioma'=>['required','min:3', 'max:10'],
                'total_paginas'=>['nullable','numeric', 'max:1'],
                'data_edicao'=>['nullable','date'],
                'isbn'=>['required','min:13','max:13'],
                'observacoes'=>['nullable','min:3', 'max:255'],
                'imagem_capa'=>['nullable'],
                'id_genero'=>['numeric', 'nullable'],
                'sinopse'=>['nullable','min:3', 'max:255'],
            ]);
            if (Auth::check()){
                $userAtual = Auth::user()->id;
                $novoLivro['id_user']=$userAtual;
            }
            $autores = $req->id_autor;
            $editoras = $req->id_editora;
            $livro = Livro::create($novoLivro);
            $livro->autores()->attach($autores);
            $livro->editoras()->attach($editoras);

            return redirect()->route('livros.show',[
                'id' => $livro->id_livro
            ]);
    }

    public function edit(Request $req){
        
       
        $editoras = Editora::all();
        $editLivro = $req->id;
        $livro=Livro::where('id_livro',$editLivro)->with(['autores','editoras','user'])->first();
        if(Gate::allows('atualizar-livro',$livro)|| Gate::allows('admin')){
            $autoresLivro = [];
            $generos = Genero::all();
            $autores = Autor::all();
   
        
            foreach($livro->autores as $autor){
                $autoresLivro[] = $autor->id_autor;
            }
            $editorasLivro = [];
            foreach($livro->editoras as $editora){
                $editorasLivro[] = $editora->id_editora;
            }
            if(isset($livro->user->id_user)){
                if(Auth()->check()){
                    if(Auth::user()->id == $livro->id_user){
                        return view('livros.edit',[
                            'livro'=>$livro,
                            'generos'=>$generos,
                            'autores'=>$autores,
                            'editoras'=>$editoras,
                            'autoresLivro'=>$autoresLivro,
                            'editorasLivro'=>$editorasLivro
                        ]);
                    }
                    else{
                        return view('index');
                    }
                }
            }
            else{
                return view('livros.edit',[
                    'livro'=>$livro,
                    'generos'=>$generos,
                    'autores'=>$autores,
                    'editoras'=>$editoras,
                    'autoresLivro'=>$autoresLivro,
                    'editorasLivro'=>$editorasLivro
                ]);
            }
        }
        else{
            return redirect()->route('livros.index')
            ->with('msg','Não tem permissão para aceder a área pretendida');
        }
    }

    public function update(Request $req){
        
        $idLivro = $req->id;
        $livro=Livro::where('id_livro',$idLivro)->first();
            if(Gate::allows('atualizar-livro',$livro)|| Gate::allows('admin')){
                $updateLivro = $req -> validate([
                    'titulo'=>['required','min:3', 'max:100'],
                    'idioma'=>['required','min:3', 'max:10'],
                    'total_paginas'=>['nullable','numeric', 'max:1'],
                    'data_edicao'=>['nullable','date'],
                    'isbn'=>['required','min:13','max:13'],
                    'observacoes'=>['nullable','min:3', 'max:255'],
                    'imagem_capa'=>['nullable'],
                    'id_genero'=>['numeric', 'nullable'],
                    'sinopse'=>['nullable','min:3', 'max:255'],
                ]);
                $autores = $req->id_autor;
                $editoras = $req->id_editora;

                $livro->update($updateLivro);
                $livro->autores()->sync($autores);
                $livro->editoras()->sync($editoras);

                return redirect()->route('livros.show',[
                    'id' => $livro->id_livro
                ]);
            }
            else{
                return redirect()->route('livros.index')
                ->with('msg','Não tem permissão para aceder a área pretendida');
            }
    }


    public function delete(Request $req){
        $idLivro = $req ->id;
        $livro = Livro::where('id_livro', $idLivro)->first();
            if(Gate::allows('atualizar-livro',$livro)|| Gate::allows('admin')){
                if(isset($livro->user->id_user)){
                    if(Auth()->check()){
                        if(Auth::user()->id == $livro->id_user){
                            if(is_null($livro)){
                                return redirect()->route('livros.index')
                                    ->with('msg','O livro não existe');
                            }
                            else
                                {
                                return view('livros.delete',[
                                'livro'=>$livro
                                ]);
                            }
                        }
                        else{
                            return view('livros.index');
                        }
                    }
                }
                else{
                    if(is_null($livro)){
                        return redirect()->route('livros.index')
                            ->with('msg','O livro não existe');
                    }
                    else{
                  
                        return view('livros.delete',[
                            'livro'=>$livro
                        ]);
                    }
                }
            }
            else{
                return redirect()->route('livros.index')
                ->with('msg','Não tem permissão para aceder a área pretendida');
            }
    }

    public function destroy(Request $req){
        $idLivro = $req ->id;
        $livro = Livro::findOrfail($idLivro);

        $autoresLivro = Livro::findOrfail($idLivro)->autores;
        $livro->autores()->detach($autoresLivro);
        
        $editorasLivro = Livro::findOrfail($idLivro)->editoras;
        $livro->editoras()->detach($editorasLivro);

        $livro->delete();

        return redirect()->route('livros.index')->with('msg','Livro eliminado!');

    }





    public function comentario(Request $req){
        $idLivro = $req ->id;

        $livro = Livro::findOrfail($idLivro);
        $comentario = $req -> validate([
            'comentario'=>['required','','min:1', 'max:255'],
        ]);
        if (Auth::check()){
            $userAtual = Auth::user()->id;
            $comentario['id_user']=$userAtual;
            
            return redirect()->route('livros.show',[
                'id' => $livro->id_livro
            ]);
        }
    }
}
