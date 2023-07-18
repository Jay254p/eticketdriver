<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions'; // Replace with your desired table name

    protected $fillable = [
        'transaction_id',
        'amount',
        'status',
        'TicketId',
        'created_at',
        
        // Add other columns as needed
    ];

    // Add any relationships or additional methods as needed
}
