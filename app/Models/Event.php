<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'event_date',
        'venue',
        'category_id',
        'event_picture',
        'capacity',
        'status',
        'approval_status',
        'approved_by',
        'approved_at'
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function eventCategories()
    {
        return $this->hasMany(EventCategory::class);
    }

    public function eventVendors()
    {
        return $this->hasMany(EventVendor::class);
    }

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'event_vendors');
    }

    public function eventPerformers()
    {
        return $this->hasMany(EventPerformer::class);
    }

    public function performers()
    {
        return $this->belongsToMany(Performer::class, 'event_performers');
    }

    public function eventRegisters()
    {
        return $this->hasMany(EventRegister::class);
    }

    public function registrations()
    {
        return $this->hasMany(EventRegister::class);
    }

    public function qnas()
    {
        return $this->hasMany(Qna::class);
    }
}
