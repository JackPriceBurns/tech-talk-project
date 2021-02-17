<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        's3_path',
        'size',
        'mime'
    ];
}
