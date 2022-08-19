<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'record', 'user_id', 'duration'];
    protected $table = 'answers';
    protected $appends = ['voted', 'positiveVote'];

    protected static function boot()
    {
        parent::boot();
        self::saving(fn($answer) => $answer->user_id = auth()->id());
        self::saved(fn($answer) => $answer->user()->update(['status' => false]));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class, 'answer_id');
    }

    public function getVotedAttribute(): bool
    {
        return $this->votes()->where('user_id', auth()->id())->exists();
    }

    public function getPositiveVoteAttribute(): bool
    {
        return $this->votes()->where('user_id', auth()->id())->first()->vote === 1;
    }
}
