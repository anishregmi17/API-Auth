<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Task Management API",
 *     description="API documentation for the Task Management system"
 * )
 *
 * @OA\Tag(
 *     name="Tasks",
 *     description="Operations related to tasks"
 * )
 */
class TaskController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     tags={"Tasks"},
     *     summary="Get all tasks",
     *     description="Retrieve a list of all tasks",
     *     @OA\Response(
     *         response=200,
     *         description="A list of tasks",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Task")
     *         )
     *     )
     * )
     *
     * Display a listing of the resource.
     */
    public function index()
    {
        // sabai task get garna
        return Task::all();
    }

    /**
     * @OA\Post(
     *     path="/api/tasks",
     *     tags={"Tasks"},
     *     summary="Create a new task",
     *     description="Create a new task with title and description",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="New Task"),
     *             @OA\Property(property="description", type="string", example="Task description")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Task created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     *
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // new task create garna
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $task = Task::create($request->all());

        return response()->json($task, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/tasks/{id}",
     *     tags={"Tasks"},
     *     summary="Get a single task",
     *     description="Retrieve a specific task by its ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Task ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task found",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found"
     *     )
     * )
     *
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // single task show garna ko lagi
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        return $task;
    }

    /**
     * @OA\Put(
     *     path="/api/tasks/{id}",
     *     tags={"Tasks"},
     *     summary="Update an existing task",
     *     description="Update a task by its ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Task ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Updated Task Title"),
     *             @OA\Property(property="description", type="string", example="Updated Task Description")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found"
     *     )
     * )
     *
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
        ]);

        $task->update($request->all());

        return response()->json($task);
    }

    /**
     * @OA\Delete(
     *     path="/api/tasks/{id}",
     *     tags={"Tasks"},
     *     summary="Delete a task",
     *     description="Delete a task by its ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Task ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found"
     *     )
     * )
     *
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted']);
    }
}
