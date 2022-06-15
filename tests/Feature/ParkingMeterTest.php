<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ParkingMeter;

class ParkingMeterTest extends TestCase
{

    protected $data = [
        'topleft' => '-73.84754478940,40.70987598800',
        'bottomright' => '-71.84754478940,42.70987598800'
    ];
    protected $dataNotFound = [
        'topleft' => '-77.84754478940,40.70987598800',
        'bottomright' => '-81.84754478940,42.70987598800'
    ];

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testListStatusParkingMeter()
    {
        $response = $this
            ->getJson(
            'api/v1/parking_meters/list?' . http_build_query($this->data)
        );
        
        $response->assertStatus(200);
    }

    public function testListResponseParkingMeter()
    {

        
        $response = $this->get('api/v1/parking_meters/list?' . http_build_query($this->data));



        $response->assertJsonStructure([
            [
                'numer',
                'type',
                'long',
                'lat',
                'active'
            ]
        ]);
    }

    public function testListFailedParkingMeter()
    {
        $response = $this
            ->getJson(
            'api/v1/parking_meters/list?' . http_build_query($this->dataNotFound)
        );

        $response->assertStatus(402);
    }
}
