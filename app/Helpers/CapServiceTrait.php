<?php
namespace App\Helpers;

use App\Models\Seek;
use App\Models\Trip;
use App\Models\Driver;
use App\Models\SeekTo;
use App\Models\Customer;
use App\Events\NotificationPusher;
use Grimzy\LaravelMysqlSpatial\Types\Point;

trait CapServiceTrait
{
    //Customer

    function set_seek($request) {

        $seek=new Seek();
        $seek->customer_id = auth('api.customer')->id();
        // $seek->service_id = 1;
        $seek->from_location = new Point($request->latitude_from, $request->longitude_from);	// (lat, lng)
        $seek->to_location = new Point($request->latitude_to, $request->longitude_to);	// (lat, lng)
        $seek->save();

        return $seek;
    }

    function cancel_seek($request, $seek) {

        $seek->update([
            'status'=>4,
            'reason_id'=>$request->reason_id
        ]);

        $dreivers = SeekTo::where('seek_id', $seek->id)->get();

        if(empty($dreivers)){
            return 'Drivers 4GO not located near your location';
        }

        foreach($dreivers as $driver){

            event(new NotificationPusher([
                'send_to'   => $driver->private_channel_pusher,
                'data'      => $seek,
                'type'      => 'cancel_cap_service'
            ]));

        }

        return 'Cancellations Successful';
    }

    function get_drivers_near($location, $distance, $seek) {

        $drivers = Driver::available()->distance('my_location', $location, $distance)->get();

        if(@$drivers->count()==0){
            return $data['message'] = 'Drivers 4GO not located near your location';
        }

        foreach($drivers as $driver){

            SeekTo::create([
                'seek_id'   => $seek->id,
                'driver_id' => $driver->id,
                'status'    => 0, //0=>pending, 1=>confirm, 2=>reject
            ]);

            event(new NotificationPusher([
                'send_to'   => $driver->private_channel_pusher,
                'data'      => $seek,
                'type'      => 'cap_service'
            ]));

            $data['drivers'][] = [
                'lat' => $driver->lat,
                'lng' => $driver->lng
            ];
        }
        $data['message'] = 'will return after 30 second';
        return $data;
    }

    //Customer

    //Driver

    function online_driver() {

        $driver = auth('api.driver')->user();

        $driver->update([
            'is_online' => 1,
            'is_available' => 1,
        ]);

        return 'Available to receive requests';
    }

    function offline_driver() {

        $driver = auth('api.driver')->user();

        $driver->update(['is_online' => 0]);

        return "You're offline now.";
    }

    function update_driver_location($request) {

        $driver = Driver::findOrFail(auth('api.driver')->id());
        $driver->my_location = new Point($request->lat, $request->lng);    // (lat, lng)
        $driver->save();

        return $driver->my_location;
    }

    function driver_confirm_request($seek) {

        $driver = Driver::find(auth('api.driver')->id());

        if($seek->status == 2){
            return 'This request has not been found or another driver accepts this request';
        }

        $seek->update(['status' => 2, 'driver_id' => $driver->id]);

        $seek_to = SeekTo::where('seek_id', $seek->id)->where('driver_id','!=', $driver->id)->get();

        foreach($seek_to as $to){

            event(new NotificationPusher([
                'send_to'   => $to->driver->private_channel_pusher,
                'data'      => $seek,
                'type'      => 'busy_cap_service'
            ]));
        }

        event(new NotificationPusher([
                'send_to'   => $seek->customer->private_channel_pusher,
                'data'      => ['seek' => $seek, 'driver'=>$driver->load('vehicles')],
                'type'      => 'cap_service'
        ]));

        $driver->update(['is_available' => 0]);

        return 'confirmed request';

    }

    function driver_reject_request($seek) {

        $driver = auth('api.driver')->user();

        $seek_to = SeekTo::where('seek_id', $seek->id)->where('driver_id', $driver->id)->first();

        if( $seek->status == 2 && empty($seek_to) ){
            return 'This request has not been found or another driver accepts this request';
        }

        $seek_to->update(['status'=>3]);

        return 'rejected request';
    }

    function driver_start_trip($seek) {

        $driver = Driver::find(auth('api.driver')->id());
        $customer = Customer::find($seek->customer_id);

        $trip = Trip::create([
            'customer_id' => $customer->id,
            'driver_id' => $driver->id,
            'vehicle_id' => $driver->vehicle[0]->id,
            'from_location' => $seek->from_location,
            'to_location' => $seek->to_location,
            'from_time' => now(),
            'to_time' => null,
            'rate' => null,
            'duration' => null,
            'distance' => null,
            'price' => null,
            'customer_name' => $customer->name,
            'customer_phone' => $customer->phone
        ]);

        event(new NotificationPusher([
                'send_to'   => $driver->private_channel_pusher,
                'data'      => $trip,
                'type'      => 'start_cap_service'
        ]));

        event(new NotificationPusher([
                'send_to'   => $customer->private_channel_pusher,
                'data'      => $trip,
                'type'      => 'start_cap_service'
        ]));

        return $trip;
    }

    function driver_end_trip($trip, $to_location) {

        $driver = Driver::find(auth('api.driver')->id());
        $customer = Customer::find($trip->customer_id);

        $trip->update([
            'to_location' => $to_location,
            'to_time' => now(),
            'rate' => null,
            'duration' => null,
            'distance' => null,
            'price' => null,
        ]);

        event(new NotificationPusher([
                'send_to'   => $driver->private_channel_pusher,
                'data'      => $trip,
                'type'      => 'end_cap_service'
        ]));

        event(new NotificationPusher([
                'send_to'   => $customer->private_channel_pusher,
                'data'      => $trip,
                'type'      => 'end_cap_service'
        ]));

        $driver->update(['is_available' => 1]);

        return $trip;
    }

    // function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'miles') {
    //     $theta = $longitude1 - $longitude2;
    //     $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
    //     $distance = acos($distance);
    //     $distance = rad2deg($distance);
    //     $distance = $distance * 60 * 1.1515;
    //     switch($unit) {
    //         case 'miles':
    //         break;
    //         case 'kilometers' :
    //         $distance = $distance * 1.609344;
    //     }
    //     return (round($distance,2));
    // }

    //Driver
}
