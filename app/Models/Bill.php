<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $room_tenant_id
 * @property Carbon $bill_month
 * @property float|int $amount
 * @property Carbon $due_date
 * @property float|int|null $fine_amount
 * @property string $status
 * @property-read RoomTenant $roomTenant
 * @property-read \Illuminate\Database\Eloquent\Collection|Payment[] $payments
 */
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

    protected $attributes = [
        'status' => 'unpaid',
    ];

    protected $casts = [
        'bill_month' => 'date',
        'due_date' => 'date',
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
