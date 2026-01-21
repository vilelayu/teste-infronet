<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Tasks;
use Illuminate\Support\Facades\Log;

class TasksController extends Controller
{
    public function index()
    {
        try{

            $list = Tasks::all();
            return $list->isEmpty()
                ? response()->noContent()
                : response()->json($list);
        }
        catch(\Exception $e){
            Log::error('Erro ao consultar a lista de task', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'message' => 'Erro ao consultar o registro'
            ], 400);
        }
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

    public function update(Request $request, $id)
    {
        return response()->json([
            'message' => "Faz Cruz {$id} atualizado"
        ]);
    }
}