<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use App\Http\Controllers;


class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dadosLivros = Livro::All();
        $contador = $dadosLivros->count();

        return 'Livros: '.$contador.  $dadosLivros. Response()->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dadosLivros = $request->All();

        $valida = Validator::make($dadosLivros, [
            'nomeLivro'=> 'required',
            'generoLivro'=> 'required',
        ]);

        if($valida->fails()){
            return 'Dados inválidos'.$valida->errors(true). 500;
        }
            $livrosBanco = Livro::create($dadosLivros);
        if($livrosBanco){
            return 'Livros cadastrados '.Response()->json([], Response::HTTP_NO_CONTENT); 
        }else{
            return 'Livros não cadastrados '.Response()->json([], Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $livrossBanco = Livro::find($id);
        $contador = $livrosBanco->count();

        if($livrosBanco){
            return 'Livro encontrados: '.$contador.' - '.$livrosBanco.response()->json([],Response::HTTP_NO_CONTENT); 
        }else{
            return 'Livro não encontrados.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $livrosDados= $request->All();

        $valida = Validator::make($livrosDados,[
            'nomeLivro' => 'required',
            'generoLivro' => 'required',
        ]);

        if($valida->fails()){
            return 'Dados incompletos '.$valida->errors(true). 500;
        }

        $livrosBanco = Livro::find($id);
        $livrosBanco->nomeLivro = $livrosDados['nomeLivro'];
        $livrosBanco->generoLivro = $livrosDados['generoLivro'];

        $RegistrosLivros = $livrosBanco->save();
        if($RegistrosLivros){
            return 'Dados alterados com sucesso.';
        }else{  
            return 'Dados não alterados'.response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $livrosBanco = Livro::find($id);
        if($livrosBanco){
            $livrosBanco->delete();
            return 'O livro foi deletado com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }else{
            return 'O livro não foi deletado.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }
    }
}
