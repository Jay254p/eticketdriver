<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt_number',
        'transaction_id',
        'payment_date',
        'amount',
        'ticket_id',
        'driver_name',
        'driver_phone_number',
        'driver_email',
        'driver_id_number',
        'driver_licence_number',
        'OffenceCommited',
        'InspectorBadgeNumber',
    ];
}
