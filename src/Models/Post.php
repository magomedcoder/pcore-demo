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
    protected string $table = 'posts';

    /**
     * @var array|string[]
     */
    protected array $fillable = [
        'id',
        'content',
        'created_at'
    ];

    /**
     * @var array|string[]
     */
    protected array $cast = [
        'created_at' => 'integer'
    ];

}