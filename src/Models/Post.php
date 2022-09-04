<?php

declare(strict_types=1);

namespace App\Models;

use PCore\Database\Models\Model;

/**
 * Class Post
 * @package App\Models
 */
class Post extends Model
{

    /**
     * @var string
     */
    protected static string $table = 'posts';

    /**
     * @var array|string[]
     */
    protected static array $fillable = [
        'id',
        'content',
        'created_at'
    ];

    /**
     * @var array|string[]
     */
    protected static array $cast = [
        'created_at' => 'integer'
    ];

}