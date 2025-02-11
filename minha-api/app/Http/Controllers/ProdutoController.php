<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(){ //listar todos os produtos.
        return Produto::all();
    }

    public function store(Request $request){ //criar um novo produto
        $produto = Produto::create($request->all());
        return response()->json($produto, 201);
    }

    public function show($id){ //exibir um produto especifico
        $produto = Produto::find($id);
        if(!$produto){
            return response()->json(['message' => 'Produto nao encontrado'], 404);
        }
        return response()->json($produto);
    }

    public function update(Request $request, $id){ //atualizar um produto
        $produto = Produto::find($id);
        if(!$produto){
            return response()->json(['message' => 'Produto nao encontrado'], 404);
        }
        $produto->update($request->all());
        return response()->json($produto);
    }
  public function destroy($id){ //deletar um produto
    $produto = Produto::find($id);
    if(!$produto){
        return response()->json(['message' => 'Produto nao encontrado'], 404);
    }
      $produto->delete();
      return response()->json(['message' => 'Produto deletado como sucesso']);
  }
}
