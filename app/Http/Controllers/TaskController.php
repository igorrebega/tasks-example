<?php

namespace App\Http\Controllers;

use App\Enums\Pagination;
use App\Http\Requests\TaskIndexRequest;
use App\Http\Resources\TaskCollectionResource;
use App\Repositories\TaskRepository;

/**
 * Class TaskController
 *
 * Basic task operations
 */
class TaskController extends Controller
{
    /**
     * List
     *
     * @param TaskIndexRequest $request        Request
     * @param TaskRepository   $taskRepository Task repository
     *
     * @return TaskCollectionResource Resource
     */
    public function index(TaskIndexRequest $request, TaskRepository $taskRepository)
    {
        $perPage = $request->get('perPage', Pagination::DEFAULT_PER_PAGE);
        $page = $request->get('page', 1);

        return new TaskCollectionResource($taskRepository->paginate($perPage, $page));
    }
}
