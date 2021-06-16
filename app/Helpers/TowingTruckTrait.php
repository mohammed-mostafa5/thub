<?php

namespace App\Helpers;

use App\Models\Seek;
use App\Models\Trip;
use App\Models\Driver;
use App\Models\Option;
use App\Models\SeekTo;
use App\Models\Customer;
use App\Models\TowingSeek;
use App\Models\TowingSeekTo;
use App\Events\NotificationPusher;
use Grimzy\LaravelMysqlSpatial\Types\Point;

trait TowingTruckTrait
{
    //Request
    function towing_set_seek($request)
    {
        $seek = new TowingSeek();
        $seek->customer_id = auth('api.customer')->id();
        $seek->service_id = 2;
        $seek->from_location = new Point($request->latitude_from, $request->longitude_from);    // (lat, lng)
        $seek->to_location = new Point($request->latitude_to, $request->longitude_to);    // (lat, lng)
        $seek->photo = $request->photo;
        $seek->save();

        return $seek;
    }

    function towing_cancel_seek($request, $seek)
    {
        $seek->update([
            'status'        => 4,
            'reason_id'     => $request->reason_id
        ]);

        $drivers = TowingSeekTo::where('seek_id', $seek->id)->get();

        if (empty($drivers)) {
            return 'Drivers 4GO not located near your location';
        }

        foreach ($drivers as $driver) {

            event(new NotificationPusher([
                'send_to'   => $driver->private_channel_pusher,
                'data'      => $seek,
                'type'      => 'cancel_towing_truck'
            ]));
        }

        return 'Cancellations Successful';
    }
    //Request

    //Driver
    function towing_online_driver()
    {

        $driver = auth('api.driver')->user();

        $driver->update([
            'is_online' => 1,
            'is_available' => 1,
        ]);

        return 'Available to receive requests';
    }

    function towing_update_driver_location($request)
    {

        $driver = Driver::findOrFail(auth('api.driver')->id());
        $driver->my_location = new Point($request->lat, $request->lng);    // (lat, lng)
        $driver->save();
        return $driver->my_location;
    }

    function towing_get_drivers_near($location, $distance, $seek)
    {

        $dreivers = Driver::available()->distance('my_location', $location, $distance)->get();

        if (@$dreivers->count() == 0) {
            return 'Drivers 4GO not located near your location';
        }

        foreach ($dreivers as $driver) {

            TowingSeekTo::create([
                'seek_id'   => $seek->id,
                'driver_id' => $driver->id,
                'status'    => 0, // 0 => in progress, 1 => pending, 2 => confirm, 3 => reject, 4 => cancel
                'photo'    => $seek->photo,
            ]);

            event(new NotificationPusher([
                'send_to'   => $driver->id,
                'data'      => $seek,
                'type'      => 'towing_truck_service'
            ]));
        }

        return 'will return after 45 second';
    }

    function towing_driver_confirm_request($seek)
    {
        $driver = auth('api.driver')->user();

        if ($seek->status == 2) {
            return 'This request has not been found or another driver accepts this request';
        }

        $seek->update(['status' => 2, 'driver_id' => $driver->id]);

        $seek_to = TowingSeekTo::where('seek_id', $seek->id)->where('driver_id', '!=', $driver->id)->get();

        foreach ($seek_to as $to) {
            event(new NotificationPusher([
                'send_to'   => $to->driver->private_channel_pusher,
                'data'      => $seek,
                'type'      => 'busy_towing_truck_service'
            ]));
        }

        return 'confirmed request';
    }

    function towing_driver_reject_request($seek)
    {

        $driver = auth('api.driver')->user();

        $seek_to = TowingSeekTo::where('seek_id', $seek->id)->where('driver_id', $driver->id)->first();

        if ($seek->status == 2 && empty($seek_to)) {
            return 'This request has not been found or another driver accepts this request';
        }
        $seek_to->update(['status' => 3]);

        return 'rejected request';
    }

    function towing_driver_start_trip($seek)
    {

        $driver = Driver::find(auth('api.driver')->id());
        $customer = Customer::find($seek->customer_id);

        $trip = Trip::create([
            'customer_id'       => $customer->id,
            'driver_id'         => $driver->id,
            'vehicle_id'        => $driver->vehicles[0]->id,
            'from_location'     => $seek->from_location,
            'to_location'       => $seek->to_location,
            'from_time'         => now(),
            'to_time'           => null,
            'rate'              => null,
            'duration'          => null,
            'distance'          => null,
            'price'             => null,
            'customer_name'     => $customer->name,
            'customer_phone'    => $customer->phone
        ]);

        event(new NotificationPusher([
            'send_to'   => $driver->private_channel_pusher,
            'data'      => $trip,
            'type'      => 'start_towing_truck_service'
        ]));

        event(new NotificationPusher([
            'send_to'   => $customer->private_channel_pusher,
            'data'      => $trip,
            'type'      => 'start_towing_truck_service'
        ]));

        return $trip;
    }

    function towing_driver_end_trip($trip, $to_location)
    {

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
            'type'      => 'end_towing_truck_service'
        ]));

        event(new NotificationPusher([
            'send_to'   => $customer->private_channel_pusher,
            'data'      => $trip,
            'type'      => 'end_towing_truck_service'
        ]));

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
}
