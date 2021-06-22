<?php

namespace App\Http\Controllers\API;

use App\Models\Option;
use App\Models\DriverRate;
use App\Models\CustomerRate;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function test()
    {
        return ('test home');
    }

    ##################################################################
    # Main
    ##################################################################

    public function update_information(Request $request)
    {
        $user = auth('api')->user();
        $data = $request->validate([
            'name'              => 'required|string|max:191',
            'phone'             => 'required|string|max:191',
            'address'           => 'nullable|string|max:191',
            'housing_type'      => 'nullable|in:1,2',
            'state_id'          => 'nullable',
            'building_number'   => 'nullable',
            'floor_number'      => 'nullable',
            'apartment_number'  => 'nullable',
            'status'            => 'nullable',
            'verify_code'       => 'nullable',
            'balance'           => 'nullable',
        ]);

        $user->update($data);

        return response()->json(compact('user'));
    }

    public function wallet()
    {
        $user = auth('api')->user();
        $balance = $user->balance;

        return response()->json(compact('balance'));
    }

    //------------------------- End Main --------------------------//



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
