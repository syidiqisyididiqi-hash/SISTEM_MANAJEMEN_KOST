<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $room_id
 * @property int $tenant_id
 * @property string|null $tenant_date
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property string $status
 * @property-read \App\Models\Room $room
 * @property-read \App\Models\Tenant $tenant
 */
class RoomTenant extends Model
{
    use HasFactory;

    public $fillable = [
        'room_id',
        'tenant_id',
        'tenant_date',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime:Y-m-d',
        'end_date' => 'datetime:Y-m-d',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
