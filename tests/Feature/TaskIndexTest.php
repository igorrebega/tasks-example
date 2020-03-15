<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class TaskIndexTest extends TestCase
{
    use DatabaseMigrations;

    public function test_it_returns_empty_if_no_data()
    {
        $response = $this->get('/api/task');

        $response->assertJsonFragment(['data' => []]);
        $response->assertStatus(200);
    }

    public function test_it_return_completed_tasks_last()
    {
        $task1 = factory(Task::class)->create([
            'is_done' => false
        ]);

        $task2 = factory(Task::class)->create([
            'is_done' => true
        ]);

        $task3 = factory(Task::class)->create([
            'is_done' => false
        ]);

        $response = $this->get('/api/task');
        $response->assertJsonFragment([
            'data' => [
                [
                    'id' => $task3->id,
                    'text' => $task3->text,
                    'is_done' => $task3->is_done,
                ],
                [
                    'id' => $task1->id,
                    'text' => $task1->text,
                    'is_done' => $task1->is_done,
                ],
                [
                    'id' => $task2->id,
                    'text' => $task2->text,
                    'is_done' => $task2->is_done,
                ]
            ]
        ]);

        $response->assertStatus(200);
    }

    public function test_pagination_work()
    {
        factory(Task::class, 15)->create();
        $response = $this->get('/api/task');

        $data = $response->json('data');

        $this->assertCount(10, $data);

        $response = $this->get('/api/task?page=2');

        $data = $response->json('data');

        $this->assertCount(5, $data);

        $response = $this->get('/api/task?page=3');

        $data = $response->json('data');

        $this->assertCount(0, $data);

        $response->assertStatus(200);
    }
}
