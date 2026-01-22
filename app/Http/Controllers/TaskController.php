<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function store(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'status_id' => 'required|integer|exists:statuses,id',
        ]);
    
        if ($validator->fails()) {
            return response(['error'=>'Данные введены некорректно.'], 422);
        } else {
            $model = new Task;
            $task = $model->create($request->all());
            return response($task, 201);
        }
    }

    public function show($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:tasks,id',
        ]);

        if ($validator->fails()) {
            return response(['error'=>'Задачи с таким ID нет в базе данных.'], 400);
        } else {
             return Task::find($id);
        }
       
    }

    public function update(Request $request, $id)
    {
        $idValidator = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:tasks,id',
        ]);

        if ($idValidator->fails()) {
            return response(['error'=>'Задачи с таким ID нет в базе данных.'], 400);
        } else {
            $task = Task::find($id);
            $dataValidator = Validator::make($request->all(), [
                'title' => 'string',
                'description' => 'string',
                'status_id' => 'integer|exists:statuses,id',
            ]);
            if ($dataValidator->fails()) {
                return response(['error'=>'Данные введены некорректно.'], 422);

            } else {
                $updatedTask = tap($task)->update($request->all());
                return response($updatedTask, 200);
            }
        }

    }

    public function destroy($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:tasks,id',
        ]);
        if ($validator->fails()) {
            return response(['error'=>'Задачи с таким ID нет в базе данных.'], 400);
        } else {
            Task::destroy($id);
            return response(null, 204);
        }
    }
}
