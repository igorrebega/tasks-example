<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskIndexRequest;
use App\Http\Resources\TaskCollectionResource;
use App\Http\Resources\TaskResource;
use App\Repositories\TaskRepository;

/**
 * Class TaskController
 *
 * Basic task operations
 */
class TaskController extends Controller
{
    /**
     * @OA\Get(
     *     path="/task",
     *     tags={"tasks"},
     *     summary="List of all tasks",
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="page number"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                  property="data", type="array",
     *                  @OA\Items(ref="#/components/schemas/Task")
     *             ),
     *             @OA\Property(
     *                  property="links", type="array",
     *                  @OA\Items(ref="#/components/schemas/PaginatorLinks")
     *             ),
     *             @OA\Property(
     *                  property="meta", type="array",
     *                  @OA\Items(ref="#/components/schemas/PaginatorMeta")
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation exception"
     *     )
     * )
     *
     * @param TaskIndexRequest $request        Request
     * @param TaskRepository   $taskRepository Repo
     *
     * @return TaskCollectionResource List of data
     */
    public function index(TaskIndexRequest $request, TaskRepository $taskRepository)
    {
        $page = $request->get('page', 1);

        return new TaskCollectionResource($taskRepository->paginate($page));
    }

    /**
     * @OA\Post(
     *     path="/task",
     *     tags={"tasks"},
     *     summary="Create task",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/TaskRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Task"),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation exception"
     *     )
     * )
     *
     * @param TaskCreateRequest $request        Request
     * @param TaskRepository    $taskRepository Repo
     *
     * @return TaskResource List of data
     */
    public function create(TaskCreateRequest $request, TaskRepository $taskRepository)
    {
        $task = $taskRepository->create($request->validated());

        return new TaskResource($task);
    }
}
