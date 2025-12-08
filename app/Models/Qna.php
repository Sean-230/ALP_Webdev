<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qna extends Model
{
    /** @use HasFactory<\Database\Factories\QnaFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'event_id',
        'user_id',
        'question',
        'answer',
        'created_at',
        'answered_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'answered_at' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
