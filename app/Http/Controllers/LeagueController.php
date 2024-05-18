<?php

namespace App\Http\Controllers;

use App\Models\League;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    /**
     * @OA\Get(
     *     path="/leagues",
     *     tags={"Leagues"},
     *     summary="Listar todas as ligas",
     *     description="Retorna uma lista de ligas",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de ligas",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/League"))
     *     )
     * )
     */
    public function index()
    {
        return League::all();
    }

    /**
     * @OA\Post(
     *     path="/leagues",
     *     tags={"Leagues"},
     *     summary="Criar nova liga",
     *     description="Cria uma nova liga",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/League")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Liga criada com sucesso"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $league = League::create($request->all());
        return response()->json($league, 201);
    }

    /**
     * @OA\Get(
     *     path="/leagues/{id}",
     *     tags={"Leagues"},
     *     summary="Mostrar detalhes de uma liga",
     *     description="Retorna os detalhes de uma liga específica",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalhes da liga",
     *         @OA\JsonContent(ref="#/components/schemas/League")
     *     )
     * )
     */
    public function show($id)
    {
        return League::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/leagues/{id}",
     *     tags={"Leagues"},
     *     summary="Atualizar uma liga",
     *     description="Atualiza os dados de uma liga específica",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/League")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Liga atualizada com sucesso"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $league = League::findOrFail($id);
        $league->update($request->all());
        return response()->json($league, 200);
    }

    /**
     * @OA\Delete(
     *     path="/leagues/{id}",
     *     tags={"Leagues"},
     *     summary="Excluir uma liga",
     *     description="Exclui uma liga específica",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Liga excluída com sucesso"
     *     )
     * )
     */
    public function destroy($id)
    {
        League::destroy($id);
        return response()->json(null, 204);
    }
}
