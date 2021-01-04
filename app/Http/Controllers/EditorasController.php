<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Editora;

class EditorasController extends Controller
{
    //
    public function index(){
        //$editoras = Editora::all()->sortbydesc('idl');
        $editoras= Editora::paginate(4);
        return view('editoras.index',[
            'editoras'=>$editoras
        ]);
    }
    public function show(Request $request){
        $idEditora = $request->id;
        //$editora=Editora::findOrFail($idEditora);
        //$editora=Editora::find($idEditora);
        $editora=Editora::where('id_editora',$idEditora)->with('livros')->first();
        return view('editoras.show',[
            'editora'=>$editora
        ]);
    }

      
    public function create(){
        if(Gate::allows('admin')){
            return view('editoras.create');
        }
        else{
            return redirect()->route('editoras.index')
            ->with('msg','Não tem permissão para aceder a área pretendida');
        }
    }

    public function store(Request $req){
        if(Gate::allows('admin')){
            $novoEditora = $req -> validate([
                'nome'=>['required','min:3', 'max:100'],
                'morada'=>['nullable','min:3', 'max:255'],
                'observacoes'=>['nullable','min:3', 'max:255']
            ]);
            $editora = Editora::create($novoEditora);

            return redirect()->route('editoras.show',[
                'id' => $editora->id_editora
            ]);
        }
        else{
            return redirect()->route('editoras.index')
            ->with('msg','Não tem permissão para aceder a área pretendida');
        }
    }

    public function edit(Request $req){
        $editEditora = $req->id;
        $editora=Editora::where('id_editora',$editEditora)->first();
        if(Gate::allows('admin')){
            return view('editoras.edit',[
                'editora'=>$editora
            ]);
        }
        else{
            return redirect()->route('editoras.index')
            ->with('msg','Não tem permissão para aceder a área pretendida');
        }
    }
    

    public function update(Request $req){
        $editEditora = $req->id;
        $editora=Editora::where('id_editora',$editEditora)->first();
        if(Gate::allows('admin')){
            $updateEditora = $req -> validate([
                'nome'=>['required','min:3', 'max:100'],
                'morada'=>['nullable','min:3', 'max:255'],
                'observacoes'=>['nullable','min:3', 'max:255']
            ]);

            $editora->update($updateEditora);

            return redirect()->route('editoras.show',[
                'id' => $editora->id_editora
            ]);
        }
        else{
            return redirect()->route('editoras.index')
            ->with('msg','Não tem permissão para aceder a área pretendida');
        }
    }


    public function delete(Request $req){
        $idEditora = $req ->id;
        $editora = Editora::where('id_editora', $idEditora)->first();
        if(Gate::allows('admin')){
            if(is_null($editora)){
                return redirect()->route('editoras.index')
                ->with('msg','A editora não existe');
            }
            else
            {
                return view('editoras.delete',[
                    'editoras'=>$editora
                ]);
            }
        }
        else{
            return redirect()->route('editoras.index')
            ->with('msg','Não tem permissão para aceder a área pretendida');
        }
    }

    public function destroy(Request $req){
        $idEditora = $req ->id;
        $editora = Editora::findOrfail($idEditora);
        
        $editora->delete();

        return redirect()->route('editoras.index')->with('msg','Editora eliminada!');

    }
}
