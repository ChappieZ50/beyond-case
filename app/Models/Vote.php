<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'answer_id', 'vote'];
    protected $table = 'answer_votes';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class, 'answer_id');
    }
}
