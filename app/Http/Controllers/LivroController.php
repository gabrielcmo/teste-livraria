<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use DB;
use Validator;

class LivroController extends Controller
{
    public function consulta_autor(Request $request){
        // Buscando autores por nome/sobrenome
        $livros_filtrados = DB::select(DB::raw("SELECT * FROM livros WHERE autor LIKE '%$request->autor%'"));
        return $livros_filtrados;
    }

    public function show($id){
        $livro = Livro::find($id);

        if($livro == null){
            return $validator->errors()->first();
        }
        
        return Livro::find($id);
    }

    public function all(){
        return Livro::all();
    }

    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:120',
            'categoria' => 'required|string|max:64',
            'codigo' => 'required|unique:livros|max:255',
            'autor' => 'required|string|max:100',
            'ebook' => 'required|boolean',
            'tamanho_arquivo' => 'nullable|numeric|min:0',
            'peso' => 'nullable|numeric|min:0',
            'pessoa_id' => 'nullable',
        ]);

        if($validator->fails()){
            return $validator->errors()->first();
        }

        $livro = new Livro;
        $livro->nome = $request->nome;
        $livro->categoria = $request->categoria;
        $livro->codigo = $request->codigo;
        $livro->autor = $request->autor;
        
        /* Se o livro for um e-book, o atributo de tamanho de arquivo é não nulo, e caso não seja um e-book,
        daí o atribulo peso será não nulo. */
        if($request->ebook){
            $livro->ebook = true;
            $livro->tamanho_arquivo = $request->tamanho_arquivo;
        }else{
            $livro->ebook = false;
            $livro->peso = $request->peso;
        }

        // Ao criar um livro, ele ainda não está vinculado a nenhuma pessoa
        $livro->pessoa_id = null;

        $livro->save();

        return $livro;
    }

    /*
        Dados da request: nome, categoria, codigo, autor, ebook, tamanho_arquivo
        peso e pessoa_id
    */
    public function update(Request $request, $id){

        /* Obs: na validação do campo "código", pode-se alterá-lo ou também manter o mesmo. Diferentemente do caso
        de criação de um livro, em que não se pode usar um código que já existe no banco de dados. */
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:120',
            'categoria' => 'required|string|max:64',
            'codigo' => 'required|unique:livros,codigo,'.$id.'|max:255',
            'autor' => 'required|string|max:100',
            'ebook' => 'required|boolean',
            'tamanho_arquivo' => 'nullable|numeric|min:0',
            'peso' => 'nullable|numeric|min:0',
            'pessoa_id' => 'nullable',
        ]);

        if($validator->fails()){
            return "Há algum erro com os dados enviados";
        }

        $livro = Livro::find($id);

        $livro->nome = $request->nome;
        $livro->categoria = $request->categoria;
        $livro->codigo = $request->codigo;
        $livro->autor = $request->autor;
        
        /*
            Se o livro for um e-book, o atributo de tamanho de arquivo é não nulo, e caso não seja um e-book,
            daí o atribulo peso será não nulo.
        */
        if($request->ebook){
            $livro->ebook = true;
            $livro->tamanho_arquivo = $request->tamanho_arquivo;
        }else{
            $livro->ebook = false;
            $livro->peso = $request->peso;
        }

        // Ao criar um livro, ele ainda não está vinculado a nenhuma pessoa
        $livro->pessoa_id = null;

        $livro->save();

        return $livro;
    }

    public function delete($id){
        $livro = Livro::find($id);

        if($livro !== null){
            $livro->delete();
            return "Livro de ID $id deletado com sucesso";
        }else{
            return "Não existe nenhum livro com esse ID";
        }
    }
}
