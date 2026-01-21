<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Tasks;

class TasksController extends Controller
{
    public function index()
    {
     $list = Tasks::all();
     return $list->isEmpty()
        ? response()->noContent()
        : response()->json($list);
    }
    public function store(Request $request)
    {
        $task = Tasks::create([
            'title' => $request->title,
            'description'=> $request->description,
            'completed'=> $request->completed ?? true,
        ]);
        return response()->json($task, 201);
    }

    public function show($id)
    {
        return response()->json([
            'message' => "Detalhe do Faz Cruz {$id}"
        ]);
    }

    public function update(Request $request, $id)
    {
        return response()->json([
            'message' => "Faz Cruz {$id} atualizado"
        ]);
    }

    public function destroy($id)
    {
        return response()->json([
            'message' => "Faz Cruz {$id} removido"
        ]);
    }
}