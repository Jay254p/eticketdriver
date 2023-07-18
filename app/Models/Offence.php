<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offence extends Model
{
    use HasFactory;
    protected $fillable = [
        'DriverName',
        'DriverLicenceNumber',
        'DriverCarRegNo',
        'DriverPhoneNumber',
        'OffenceCommited',
        'PlaceOfOffence',
        'InspectorBadgeNumber',
    ];
    public function driver()
{
    return $this->belongsTo(Driver::class, 'DriverLicenceNumber', 'licencenumber');
}
public function offencelist()
{
    return $this->belongsTo(Offencelist::class, 'OffenceCommited', 'offencename');
}


}
