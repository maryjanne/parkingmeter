<?php

namespace App\Transformers;

use App\Models\ParkingMeter;
use League\Fractal\TransformerAbstract;

class ParkingMeterTransformer extends TransformerAbstract
{

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ParkingMeter $resource)
    {
       return [
            'numer' => (int) $resource->meter_no,
            'type' => (string) $resource->meter_type,
            'long' => (double) $resource->long,
            'lat' => (double) $resource->lat,
            'active' => (bool) $resource->status,
        ];
    }

}
