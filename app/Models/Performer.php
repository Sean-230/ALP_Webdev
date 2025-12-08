<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performer extends Model
{
    /** @use HasFactory<\Database\Factories\PerformerFactory> */
    use HasFactory;

    protected $fillable = ['name', 'photo'];

    public function eventPerformers()
    {
        return $this->hasMany(EventPerformer::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_performers');
    }
}
