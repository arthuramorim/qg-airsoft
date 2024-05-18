<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function index()
    {
        return Operator::with('team')->get();
    }

    public function store(Request $request)
    {
        $operator = Operator::create($request->all());
        return response()->json($operator, 201);
    }

    public function show($id)
    {
        return Operator::with('team')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $operator = Operator::findOrFail($id);
        $operator->update($request->all());
        return response()->json($operator, 200);
    }

    public function destroy($id)
    {
        Operator::destroy($id);
        return response()->json(null, 204);
    }
}
