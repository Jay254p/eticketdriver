<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appeal extends Model
{
    use HasFactory;
    protected $fillable = [ 
            'TicketId',
            'licencenumber',
            'badgenumber',
            'time',
            'roomnumber',
            'status',
            'verdict',

            
    ];

    public function offence()
    {
        return $this->belongsTo(Offence::class, 'TicketId', 'TicketId');
    }
}
