<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Models\User;
use App\Models\Driver;
use Illuminate\Http\Request;
use App\Mail\RegistrationMail;
use App\Helpers\HelperFunctionTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use HelperFunctionTrait, AuthenticatesUsers;

    // Start user

    public function login_or_register_user(Request $request)
    {
        $phone = $request->validate(['phone' => 'required|numeric']);

        $user = User::where($phone)->firstOr(function () {
            return User::create(['phone' => request('phone')]);
        });

        $user->update(['verify_code' => $this->randomCode(4)]);

        return response()->json(['msg' => 'A confirmation code has been sent, check your inbox', 'code' => $user->verify_code]);
    }


    public function verify_code_user(Request $request)
    {
        $inputs = $request->validate(['phone' => 'required|numeric', 'verify_code' => 'required|min:4|max:5']);

        $user = User::firstWhere($inputs);

        if (empty($user)) {
            return response()->json(['msg' => 'Verify code is not correct'], 403);
        }
        // dd($user->id);
        $token = auth('api')->tokenById($user->id);
        // $token = auth('api')->attempt($inputs);

        return response()->json(compact('user', 'token'));
    }

    // End user

    // Start Driver

    public function login_or_register_driver(Request $request)
    {
        $phone = $request->validate(['phone' => 'required|numeric']);

        $driver = Driver::where($phone)->firstOr(function () {
            return Driver::create(['phone' => request('phone')]);
        });

        $driver->update(['verify_code' => $this->randomCode(4)]);

        return response()->json(['msg' => 'A confirmation code has been sent, check your inbox', 'code' => $driver->verify_code]);
    }

    public function verify_code_driver(Request $request)
    {
        $inputs = $request->validate(['phone' => 'required|numeric', 'verify_code' => 'required|min:4|max:5']);

        $driver = Driver::firstWhere($inputs);

        if (empty($driver)) {
            return response()->json(['msg' => 'Verify code is not correct'], 403);
        }

        $token = auth('api.driver')->tokenById($driver->id);

        return response()->json(compact('driver', 'token'));
    }

    // End Driver


    public function logout()
    {
        auth('api')->logout();

        return response()->json(['msg' => 'success']);
    }
}
