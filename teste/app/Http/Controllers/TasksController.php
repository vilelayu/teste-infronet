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
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed'   => 'boolean'
        ]);

        try {
            $task = Tasks::create($data);

            return response()->json([
                'message' => 'Task criada com sucesso',
                'data' => $task
            ], 201);

        } catch (\Throwable $e) {

            Log::error('Erro ao criar task', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'message' => 'Erro ao criar task'
            ], 500);
        }     
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed'   => 'boolean'
        ]);

        try {
            $task = Tasks::findOrFail($id);

            $task->update($data);

            return response()->json([
                'message' => 'Task atualizada com sucesso',
                'data' => $task
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json([
                'message' => 'Task não encontrada'
            ], 404);

        } catch (\Throwable $e) {

            Log::error('Erro ao atualizar task', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'message' => 'Erro ao atualizar task'
            ], 500);
        }
    }
}