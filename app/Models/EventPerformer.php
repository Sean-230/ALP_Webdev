<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPerformer extends Model
{
    /** @use HasFactory<\Database\Factories\EventPerformerFactory> */
    use HasFactory;

    protected $fillable = ['event_id', 'performer_id'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function performer()
    {
        return $this->belongsTo(Performer::class);
    }
}
