<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class TaskDoneAndUndoneTest extends TestCase
{
    use DatabaseMigrations, InteractsWithDatabase;

    public function test_task_can_be_marked_as_done()
    {
        $task = factory(Task::class)->create([
            'is_done' => false
        ]);

        $this->put('/api/task/' . $task->id . '/done');

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'is_done' => true
        ]);
    }

    public function test_task_can_be_marked_as_undone()
    {
        $task = factory(Task::class)->create([
            'is_done' => true
        ]);

        $this->put('/api/task/' . $task->id . '/undone');

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'is_done' => false
        ]);
    }
}
