<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::all();
        return response()->json($produtos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validate = $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'valor' => 'required',
            'quantidade' => 'required',
        ]);

        $produto = Produto::create([
            'nome' => $validate['nome'],
            'descricao' => $validate['descricao'],
            'valor' => $validate['valor'],
            'quantidade' => $validate['quantidade'],
        ]);
        return response()->json([
            'message' => 'Produto cadastrado com sucesso!',
            'produto' => $produto
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $produto = Produto::find($id);
        return response()->json([
            'message' => 'Produto Encontrado com sucesso!',
            'produto' => $produto
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto): JsonResponse
    {
        $validated = $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'valor' => 'required',
            'quantidade' => 'required',
        ]);

        $produto = $produto->update([
            'nome' => $validated['nome'],
            'descricao' => $validated['descricao'],
            'valor' => $validated['valor'],
            'quantidade' => $validated['quantidade'],
        ]);

        return response()->json([
            'message' => 'Produto atualizado com sucesso!',
            'produto' => $produto
        ],200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        produto::destroy($id);
        return response()->json([
            'message' => 'Produto removido com sucesso!'
        ],200);
    }
}
