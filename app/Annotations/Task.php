<?php

/**
 * Class Task
 *
 * @OA\Schema()
 */
class Task
{
    /**
     * @OA\Property(type="integer")
     */
    public $id;

    /**
     * @OA\Property(type="string")
     */
    public $text;

    /**
     * @OA\Property(type="boolean")
     */
    public $is_done;
}
