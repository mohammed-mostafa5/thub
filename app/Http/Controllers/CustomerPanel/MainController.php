<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Mail\RegistrationMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class MainController extends Controller
{

    public function profile(Customer $customer) {

        return response()->json(['customer'=>$customer],200);
    }

    public function setting(Customer $customer) {
        return response()->json(['customer'=>$customer],200);
    }

    public function update(Customer $customer) {
        $inputs=$request->validate(Customer::$rules);
        $inputs['status'] = $customer->status == 2 ? 0 : $customer->status;
        $customer->updated($inputs);
        return response()->json(['customer'=>$customer],200);
    }

}
