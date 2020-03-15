<?php

namespace App\Repositories;

use App\Enums\Pagination;
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
     * @param int $page Page number
     *
     * @return LengthAwarePaginator Paginator
     */
    public function paginate(int $page)
    {
        return $this->newQuery()
            ->orderBy('is_done', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(Pagination::DEFAULT_PER_PAGE, ['*'], 'page', $page);
    }

    /**
     * Update done param
     *
     * @param int  $taskId Task id
     * @param bool $isDone True if done
     */
    public function updateDone(int $taskId, bool $isDone)
    {
        $this->newQuery()->where('id', $taskId)->update(['is_done' => $isDone]);
    }
}
