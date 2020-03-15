<?php

/**
 * Class PaginatorMeta
 *
 * @OA\Schema()
 */
class PaginatorMeta
{
    /**
     * @OA\Property(type="integer")
     */
    public $current_page;

    /**
     * @OA\Property(type="integer")
     */
    public $from;

    /**
     * @OA\Property(type="integer")
     */
    public $last_page;

    /**
     * @OA\Property(type="string")
     */
    public $path;

    /**
     * @OA\Property(type="per_page")
     */
    public $per_page;

    /**
     * @OA\Property(type="integer")
     */
    public $to;

    /**
     * @OA\Property(type="integer")
     */
    public $total;
}
