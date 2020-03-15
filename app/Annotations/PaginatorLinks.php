<?php

/**
 * Class PaginatorLinks
 *
 * @OA\Schema()
 */
class PaginatorLinks
{
    /**
     * @OA\Property(type="string")
     */
    public $first;

    /**
     * @OA\Property(type="string")
     */
    public $last;

    /**
     * @OA\Property(type="string")
     */
    public $previous;

    /**
     * @OA\Property(type="string")
     */
    public $next;
}
