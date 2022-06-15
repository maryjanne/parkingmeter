<?php
namespace App\Http\Controllers\Spots;

use App\Models\ParkingMeter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Spots\ListParkingMeterRequest;
use App\Transformers\ParkingMeterTransformer;
use League\Fractal\Resource\Collection as FractalCollection;
use League\Fractal\Manager;

class ParkingMeterController extends Controller
{
    
    
    public function listing(ListParkingMeterRequest $request)
    {
        $topLeftLong = data_get(explode(',', $request->get('topleft')), 1);
        $topLeftLat = data_get(explode(',', $request->get('topleft')), 0);
        $bottomRightLong = data_get(explode(',', $request->get('bottomright')), 1);
        $bottomRightLat = data_get(explode(',', $request->get('bottomright')), 0);
        $status = $request->get('active');
        \DB::enableQueryLog();
        $results = ParkingMeter::select('meter_no', 'meter_type', 'long', 'lat', 'status')->whereBetween('long', [$topLeftLat, $bottomRightLat])->whereBetween('lat', [$topLeftLong, $bottomRightLong]);
        if ($status) {
            $results->where('status', $status);
        }
        $fractal = new Manager();
        $resource = new FractalCollection($results->get(), new ParkingMeterTransformer);
        $values = $fractal->createData($resource)->toArray();
        if (!data_get($values, 'data')) {
            return abort(402, 'No parking meters found');
        }
        \Log::debug('results', [data_get($values, 'data')]);
        return json_encode(data_get($values, 'data'));
    }
}
