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
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'valor' => 'required|numeric',
            'quantidade' => 'required|integer',
            'status' => 'required',
        ]);

        $produto = Produto::create($validated);

        return response()->json([
            'message' => 'Produto cadastrado com sucesso!',
            'produto' => $produto
        ], 201);
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'valor' => 'required',
            'quantidade' => 'required',
            'status' => 'required',
        ]);

        $produto = Produto::findOrFail($id);

        $produto->update($validated);

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
