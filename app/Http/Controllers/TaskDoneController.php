<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Repositories\TaskRepository;
use Exception;

/**
 * Class TaskDoneController
 *
 * Operations with task done/undone
 */
class TaskDoneController extends Controller
{
    /**
     * @OA\Put(
     *     path="/task/{task}/done",
     *     tags={"tasks"},
     *     summary="Mark task as done",
     *     @OA\Parameter(
     *          in="path",
     *          required=true,
     *          name="task",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found",
     *         @OA\JsonContent(),
     *     )
     * )
     *
     * @param Task           $task           Task
     * @param TaskRepository $taskRepository Repo
     *
     * @return mixed[] Array with result
     *
     * @throws Exception
     */
    public function create(Task $task, TaskRepository $taskRepository)
    {
        $taskRepository->updateDone($task->id, true);

        return ['success' => 1];
    }

    /**
     * @OA\Put(
     *     path="/task/{task}/undone",
     *     tags={"tasks"},
     *     summary="Mark task as undone",
     *     @OA\Parameter(
     *          in="path",
     *          required=true,
     *          name="task",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found",
     *         @OA\JsonContent(),
     *     )
     * )
     *
     * @param Task           $task           Task
     * @param TaskRepository $taskRepository Repo
     *
     * @return mixed[] Array with result
     *
     * @throws Exception
     */
    public function destroy(Task $task, TaskRepository $taskRepository)
    {
        $taskRepository->updateDone($task->id, false);

        return ['success' => 1];
    }
}
