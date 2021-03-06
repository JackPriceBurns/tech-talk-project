<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'text',
        'ip_address'
    ];

    /**
     * @return HasMany
     */
    public function votes()
    {
        return $this->hasMany(QuestionVote::class);
    }
}
