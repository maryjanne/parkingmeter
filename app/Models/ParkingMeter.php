<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingMeter extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'parking_meters';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'meter_no',
        'meter_type',
        'long',
        'lat',
        'status',
        'borough'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => 'boolean'
    ];

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status == 1;
    }
}
