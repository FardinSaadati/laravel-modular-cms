<?php

namespace App\Http\Controllers\api;

use App\Facade\Facades\OilSettings;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Events\Events;
use Modules\Products\Manufacture;

class settingsController extends Controller
{
    public function getAllSettings()
    {
        $settings = OilSettings::getApiStyle(['site' , 'social']);
        $brands = Manufacture::all();

        $newEvent = null;

        if (hasModule('Events')){
            $event = Events::published()->whereDate('event_date', '>=', Carbon::now())->orderBy('event_date' , 'ASC')->first();
            if ($event) {
                $newEvent = $event;
            }
        }

        $final = array_prepend( $settings , true , 'isLoaded' );
        $finalData = array_prepend( $final , $brands , 'brands' );
        $finalData = array_prepend( $finalData , $newEvent , 'event' );

        return response()->json($finalData);
    }

}
