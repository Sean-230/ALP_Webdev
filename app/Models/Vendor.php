<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    /** @use HasFactory<\Database\Factories\VendorFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'description', 'logo'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function eventVendors()
    {
        return $this->hasMany(EventVendor::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_vendors');
    }
}
