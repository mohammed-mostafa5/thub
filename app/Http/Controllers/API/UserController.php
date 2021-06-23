<?php

namespace App\Http\Controllers\API;

use App\Models\Option;
use App\Models\DriverRate;
use App\Models\CustomerRate;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationPhoto;

class UserController extends Controller
{

    public function test()
    {
        return ('test home');
    }

    ##################################################################
    # Dashboard
    ##################################################################

    public function update_information(Request $request)
    {
        $user = auth('api')->user();
        $data = $request->validate([
            'name'              => 'required|string|max:191',
            'address'           => 'nullable|string|max:191',
            'housing_type'      => 'nullable|in:1,2',
            'state_id'          => 'nullable',
            'building_number'   => 'nullable',
            'floor_number'      => 'nullable',
            'apartment_number'  => 'nullable',
        ]);

        $user->userable()->update($data);
        $user->load('userable');

        return response()->json(compact('user'));
    }

    public function wallet()
    {
        $user = auth('api')->user();
        $balance = $user->balance;

        return response()->json(compact('balance'));
    }



    //------------------------- End Dashboard --------------------------//



    ##################################################################
    # Donation
    ##################################################################

    public function donate()
    {
        $customer = auth('api')->user()->userable;
        $data = request()->validate([
            'name'              => 'required|string|max:191',
            'address'           => 'required|string|max:191',
            'state_id'          => 'required|exists:states,id',
            'housing_type'      => 'required|in:1,2',
            'house_number'      => 'nullable|numeric',
            'building_number'   => 'nullable|numeric',
            'floor_number'      => 'nullable|numeric',
            'apartment_number'  => 'nullable|numeric',
            'pickup_date'       => 'required|date',
            'photos*'           => 'required|array',
            'photos'            => 'required|mimes:png,jpg,jpeg',
        ]);
        $data['customer_id'] = $customer->id();

        $customer->update([
            'name'              => $data['name'],
            'address'           => $data['address'],
            'state_id'          => $data['state_id'],
            'housing_type'      => $data['housing_type'],
            'house_number'      => $data['house_number'],
            'building_number'   => $data['building_number'],
            'floor_number'      => $data['floor_number'],
            'apartment_number'  => $data['apartment_number'],
        ]);
        $donation = Donation::create([
            'pickup_date'       => $data['pickup_date'],
        ]);

        foreach ($data['photos'] as $photo) {
            DonationPhoto::create([
                'donation_id'   => $donation->id,
                'photo'         => $photo,
            ]);
        }

        return response()->json($data);
    }

    //--------------------- End Donation -----------------------//



    ##################################################################
    # Notifications
    ##################################################################

    public function notifications()
    {
        $notifications = Notification::customer()->get();

        return response()->json($notifications, 200);
    }

    public function notification(Notification $notification)
    {
        return response()->json($notification, 200);
    }

    //--------------------- End Notifications -----------------------//


    ##################################################################
    # Rates
    ##################################################################

    public function rates($customerId)
    {
        $data['rates'] = CustomerRate::where('customer_id', $customerId)->get();
        $data['rates']->load('customer', 'driver');
        return response()->json($data);
    }

    public function rate(CustomerRate $customerRate)
    {
        $customerRate->load('customer', 'driver');
        return response()->json($customerRate);
    }

    public function addOrUpdateRate()
    {
        $validated = request()->validate([
            'driver_id'         => 'required',
            'rate'              => 'required',
            'report'            => 'required',
        ]);

        $validated['customer_id'] =  auth('api.customer')->id();

        $data['rate'] = DriverRate::updateOrCreate([
            'customer_id'   => auth('api.customer')->id(),
            'driver_id'     => request('driver_id')
        ], $validated);
        $data['rate']->load('customer', 'driver');
        return response()->json($data);
    }

    //--------------------- End Rates -----------------------//






}
