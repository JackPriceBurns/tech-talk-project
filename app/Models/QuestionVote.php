<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuestionVote extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'ip_address'
    ];
}
