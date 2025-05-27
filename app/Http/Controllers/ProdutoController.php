<?php

namespace App\Http\Controllers;
use App\Models\Produto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ProdutoRequest;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::all();
        if ($produtos->isEmpty()) {
            return response()->json(['message' => 'Nenhum registro encontrado.'], 404);
        }
        return response()->json($produtos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdutoRequest $request): JsonResponse
    {
       $validated = $request->validated();

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

        if ($produto === null) {
            return response()->json([
                'message' => 'Nenhum registro encontrado.'
            ],404);
        }
        return response()->json([
            'message' => 'Produto Encontrado com sucesso!',
            'produto' => $produto
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdutoRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();

        $produto = Produto::find($id);
        if ($produto === null) {
            return response()->json([
                'message' => 'Nenhum registro encontrado para edição.'
            ],404);
        }
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
        $produto = Produto::find($id);

        if ($produto === null) {
            return response()->json([
                'message' => 'Produto não encontrado para ser deletado'
            ], 404);
        }

        $produto->delete();

        return response()->json([
            'message' => 'Produto removido com sucesso!'
        ],200);
    }
}
