<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class TaskCreateTest extends TestCase
{
    use DatabaseMigrations, InteractsWithDatabase;

    public function test_it_creates_task()
    {
        $this->post('/api/task', [
            'text' => 'test2'
        ]);

        $this->assertDatabaseHas('tasks', [
            'text' => 'test2'
        ]);
    }

    public function test_validation_fails_if_text_wrong()
    {
        $request = $this->post('/api/task', [
            'text' => ''
        ]);

        $request->assertStatus(302);

        $this->assertDatabaseMissing('tasks', [
            'text' => ''
        ]);
    }
}
