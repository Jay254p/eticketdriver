<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class STKPush extends Model
{
    protected $table = 'stk_pushes';

    protected $fillable = [
        'transaction_id',
        'amount',
        'phone',
        'TicketId',
    ];

}
