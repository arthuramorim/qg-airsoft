<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LeagueController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\OperatorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="API de Gestão de Ligas de Airsoft",
 *     description="Documentação da API para o sistema de gestão de ligas de airsoft",
 *     @OA\Contact(
 *         email="seuemail@example.com"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 */

/**
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Host"
 * )
 */

/**
 * @OA\Schema(
 *     schema="League",
 *     type="object",
 *     title="League",
 *     required={"name"},
 *     properties={
 *         @OA\Property(
 *             property="name",
 *             type="string",
 *             description="Nome da liga"
 *         ),
 *         @OA\Property(
 *             property="description",
 *             type="string",
 *             description="Descrição da liga"
 *         )
 *     }
 * )
 *
 * @OA\Schema(
 *     schema="Team",
 *     type="object",
 *     title="Team",
 *     required={"name", "league_id"},
 *     properties={
 *         @OA\Property(
 *             property="name",
 *             type="string",
 *             description="Nome do time"
 *         ),
 *         @OA\Property(
 *             property="league_id",
 *             type="integer",
 *             description="ID da liga"
 *         )
 *     }
 * )
 *
 * @OA\Schema(
 *     schema="Operator",
 *     type="object",
 *     title="Operator",
 *     required={"name", "team_id"},
 *     properties={
 *         @OA\Property(
 *             property="name",
 *             type="string",
 *             description="Nome do operador"
 *         ),
 *         @OA\Property(
 *             property="team_id",
 *             type="integer",
 *             description="ID do time"
 *         )
 *     }
 * )
 */

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
Route::get('/leagues', [LeagueController::class, 'index']);

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
Route::post('/leagues', [LeagueController::class, 'store']);

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
Route::get('/leagues/{id}', [LeagueController::class, 'show']);

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
Route::put('/leagues/{id}', [LeagueController::class, 'update']);

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
Route::delete('/leagues/{id}', [LeagueController::class, 'destroy']);

/**
 * @OA\Get(
 *     path="/teams",
 *     tags={"Teams"},
 *     summary="Listar todos os times",
 *     description="Retorna uma lista de times",
 *     @OA\Response(
 *         response=200,
 *         description="Lista de times",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Team"))
 *     )
 * )
 */
Route::get('/teams', [TeamController::class, 'index']);

/**
 * @OA\Post(
 *     path="/teams",
 *     tags={"Teams"},
 *     summary="Criar novo time",
 *     description="Cria um novo time",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Team")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Time criado com sucesso"
 *     )
 * )
 */
Route::post('/teams', [TeamController::class, 'store']);

/**
 * @OA\Get(
 *     path="/teams/{id}",
 *     tags={"Teams"},
 *     summary="Mostrar detalhes de um time",
 *     description="Retorna os detalhes de um time específico",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalhes do time",
 *         @OA\JsonContent(ref="#/components/schemas/Team")
 *     )
 * )
 */
Route::get('/teams/{id}', [TeamController::class, 'show']);

/**
 * @OA\Put(
 *     path="/teams/{id}",
 *     tags={"Teams"},
 *     summary="Atualizar um time",
 *     description="Atualiza os dados de um time específico",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Team")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Time atualizado com sucesso"
 *     )
 * )
 */
Route::put('/teams/{id}', [TeamController::class, 'update']);

/**
 * @OA\Delete(
 *     path="/teams/{id}",
 *     tags={"Teams"},
 *     summary="Excluir um time",
 *     description="Exclui um time específico",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Time excluído com sucesso"
 *     )
 * )
 */
Route::delete('/teams/{id}', [TeamController::class, 'destroy']);

/**
 * @OA\Get(
 *     path="/operators",
 *     tags={"Operators"},
 *     summary="Listar todos os operadores",
 *     description="Retorna uma lista de operadores",
 *     @OA\Response(
 *         response=200,
 *         description="Lista de operadores",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Operator"))
 *     )
 * )
 */
Route::get('/operators', [OperatorController::class, 'index']);

/**
 * @OA\Post(
 *     path="/operators",
 *     tags={"Operators"},
 *     summary="Criar novo operador",
 *     description="Cria um novo operador",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Operator")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Operador criado com sucesso"
 *     )
 * )
 */
Route::post('/operators', [OperatorController::class, 'store']);

/**
 * @OA\Get(
 *     path="/operators/{id}",
 *     tags={"Operators"},
 *     summary="Mostrar detalhes de um operador",
 *     description="Retorna os detalhes de um operador específico",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalhes do operador",
 *         @OA\JsonContent(ref="#/components/schemas/Operator")
 *     )
 * )
 */
Route::get('/operators/{id}', [OperatorController::class, 'show']);

/**
 * @OA\Put(
 *     path="/operators/{id}",
 *     tags={"Operators"},
 *     summary="Atualizar um operador",
 *     description="Atualiza os dados de um operador específico",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Operator")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Operador atualizado com sucesso"
 *     )
 * )
 */
Route::put('/operators/{id}', [OperatorController::class, 'update']);

/**
 * @OA\Delete(
 *     path="/operators/{id}",
 *     tags={"Operators"},
 *     summary="Excluir um operador",
 *     description="Exclui um operador específico",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Operador excluído com sucesso"
 *     )
 * )
 */
Route::delete('/operators/{id}', [OperatorController::class, 'destroy']);
