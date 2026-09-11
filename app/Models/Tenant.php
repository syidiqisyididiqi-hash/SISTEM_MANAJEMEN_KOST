<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'identity_number',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function roomTenants()
    {
        return $this->hasMany(RoomTenant::class);
    }
}
