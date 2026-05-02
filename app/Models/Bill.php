<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_tenant_id',
        'bill_month',
        'amount',
        'due_date',
        'fine_amount',
        'status',
    ];

    protected $dates = [
        'bill_month',
        'due_date',
    ];

    public function roomTenant()
    {
        return $this->belongsTo(RoomTenant::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
