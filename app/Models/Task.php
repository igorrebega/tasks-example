<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 */
class Task extends Model
{
    /** @var mixed[] Disable guard */
    protected $guarded = [];

    /** @var string[] Cast Rules */
    protected $casts = [
        'is_done' => 'bool'
    ];
}
