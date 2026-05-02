<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_id',
        'paid_at',
        'amount',
        'method',
    ];

    protected $dates = [
        'paid_at',
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
