<?php

declare(strict_types=1);

namespace App\Models;

use PCore\Database\Models\Model;

/**
 * Class Example
 * @package App\Models
 */
class Example extends Model
{

    protected string $table = 'examples';

    protected array $fillable = [
        'title'
    ];

    protected array $cast = [
        'status' => 'integer'
    ];

    protected array $hidden = [
        'secret'
    ];

}