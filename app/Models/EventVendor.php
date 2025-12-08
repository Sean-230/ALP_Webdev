<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventVendor extends Model
{
    /** @use HasFactory<\Database\Factories\EventVendorFactory> */
    use HasFactory;

    protected $fillable = ['event_id', 'vendor_id'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
