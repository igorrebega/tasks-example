<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class TaskRepository
 */
class TaskRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function model(): string
    {
        return Task::class;
    }

    /**
     * Get list of tasks with pagination
     *
     * @param int $perPage Per page
     * @param int $page    Page
     *
     * @return LengthAwarePaginator Paginator
     */
    public function paginate(int $perPage, int $page)
    {
        return $this->newQuery()->paginate($perPage, ['*'], 'page', $page);
    }
}
