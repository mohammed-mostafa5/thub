<?php

namespace App\Http\Controllers\API;


use App\Models\Trip;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Option;
use App\Models\Service;
use App\Models\VehicleModel;
use App\Models\VehiclePhotos;
use App\Models\VehicleType;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
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
        $company = auth('api.company')->user();

        if (!$company->status) {
            $data = $request->validate([
                'name'                  => 'required|string|max:191',
                'company_name'          => 'required|string|max:191',
                'phone'                 => 'required|string|max:191|unique:companies,phone,' . $company->id,
                'email'                 => 'required|email|max:191|unique:companies,email,' . $company->id,
                'address'               => 'required|string|max:191',
                'logo'                  => 'required|image|mimes:jpeg,jpg,png',
                'commercial_register'   => 'required|image|mimes:jpeg,jpg,png',
                'tax_identification'    => 'nullable|image|mimes:jpeg,jpg,png',
                'identity_card'         => 'nullable|image|mimes:jpeg,jpg,png',
                'establishment_card'    => 'nullable|image|mimes:jpeg,jpg,png',
            ]);
        } else {
            $data = $request->validate([
                'name'                  => 'required|string|max:191',
                'company_name'          => 'required|string|max:191',
                'phone'                 => 'required|string|max:191|unique:companies,phone,' . $company->id,
                'email'                 => 'required|email|max:191|unique:companies,email,' . $company->id,
                'address'               => 'required|string|max:191',
                'logo'                  => 'nullable|image|mimes:jpeg,jpg,png',
                'commercial_register'   => 'nullable|image|mimes:jpeg,jpg,png',
                'tax_identification'    => 'nullable|image|mimes:jpeg,jpg,png',
                'identity_card'         => 'nullable|image|mimes:jpeg,jpg,png',
                'establishment_card'    => 'nullable|image|mimes:jpeg,jpg,png',
            ]);
        }

        $data['status'] = $company->status == 0 ? 1 : $company->status;
        $company->update($data);

        return response()->json(['msg' =>  'Update Information Success', 'company' => $company]);
    }

    public function wallet()
    {
        $company = auth('api.company')->user();
        $balance = $company->balance;

        return response()->json(compact('balance'));
    }

    public function revenue(Request $request)
    {
        $query = Trip::query()->groupBy('driver_id')
            ->selectRaw('driver_id, count(id) as trips_count, sum(price) as total');

        if (request()->filled('driver_id')) {
            $query->where('driver_id', request('driver_id'));
        }

        $from = request()->filled('from') ? request('from') : '2000-5-22';
        $to = request()->filled('to') ? request('to') : now();

        if (request()->filled('from') || request()->filled('to')) {
            $query->whereBetween('created_at', [$from, $to]);
        }

        $revenue = $query->with('driver')->paginate(10);

        return response()->json(compact('revenue'));
    }

    //------------------------- End Main ---------------------------//



    ##################################################################
    # Drivers
    ##################################################################

    public function drivers()
    {
        $company = auth('api.company')->user();
        $drivers = Driver::where('company_id', $company->id)->get();

        return response()->json(compact('drivers'));
    }

    public function driver($id)
    {
        $company = auth('api.company')->user();
        $driver = Driver::where('company_id', $company->id)
            ->where('id', $id)
            ->first();

        if (empty($driver)) {
            return response()->json(['msg' => 'The driver is not found, Please check your data'], 403);
        }

        return response()->json(compact('driver'));
    }

    public function driver_store(Request $request)
    {
        $company = auth('api.company')->user();
        $inputs = $request->validate(Driver::$rules);
        $inputs['company_id'] = $company->id;
        $inputs['status'] = $company->status;

        $driver = Driver::create($inputs);

        return response()->json(compact('driver'));
    }

    public function driver_update(Request $request, $id)
    {
        $company = auth('api.company')->user();

        $driver = Driver::where('company_id', $company->id)
            ->where('id', $id)
            ->first();

        if (empty($driver)) {
            return response()->json(['msg' => 'The driver is not found, Please check your data'], 403);
        }

        $inputs = $request->validate([
            'name' => 'nullable|string|min:3|max:191',
            'address' => 'nullable|string|min:3|max:191',
            'phone' => 'nullable|string|min:10|max:15|unique:drivers,phone,' . $driver->id,
            'email' => 'nullable|email|max:191|unique:drivers,email,' . $driver->id,
            'photo' => 'nullable|image|mimes:jpeg,jpg,png',
            'medical_report' => 'nullable|image|mimes:jpeg,jpg,png',
            'identity_card' => 'nullable|image|mimes:jpeg,jpg,png',
            'police_clearance_certificate' => 'nullable|image|mimes:jpeg,jpg,png',
            'driver_licence' => 'nullable|image|mimes:jpeg,jpg,png'
        ]);

        $driver->update($inputs);

        return response()->json(compact('driver'));
    }

    public function driver_delete(Request $request, $id)
    {
        $company = auth('api.company')->user();

        $driver = Driver::where('company_id', $company->id)
            ->where('id', $id)
            ->first();

        if (empty($driver)) {
            return response()->json(['msg' => 'The driver is not found, Please check your data'], 403);
        }

        $driver->delete();

        return response()->json(['msg' => __('messages.deleted', ['model' => __('models/drivers.singular')])]);
    }

    //------------------------ End Drivers -------------------------//



    ##################################################################
    # Vehicles
    ##################################################################


    public function vehicle_attributes()
    {
        $services = Service::get();
        $brands = Brand::get();
        $veicle_types = VehicleType::get();
        $min_model_year = Option::first()->min_model_year;

        return response()->json(compact('services', 'brands', 'veicle_types', 'min_model_year'));
    }

    public function vehicle_model($brand)
    {
        $model = VehicleModel::where('brand_id', $brand)->get();

        return response()->json(compact('model'));
    }

    public function vehicles()
    {
        $company = auth('api.company')->user();
        $vehicles = Vehicle::with('photos', 'brand', 'model', 'type', 'service', 'company')->where('company_id', $company->id)->get();

        return response()->json(compact('vehicles'));
    }

    public function vehicle($id)
    {
        $company = auth('api.company')->user();
        $vehicle = Vehicle::with('photos', 'brand', 'model', 'type', 'service', 'company')->where('company_id', $company->id)
            ->where('id', $id)
            ->first();

        if (empty($vehicle)) {
            return response()->json(['msg' => 'The vehicle is not found, Please check your data'], 403);
        }

        return response()->json(compact('vehicle'));
    }

    public function vehicle_store(Request $request)
    {
        request()->validate([
            'vehicle_photos' => 'required|array',
            'vehicle_photos.*' => 'required|image|mimes:jpeg,jpg,png',
        ]);

        $company = auth('api.company')->user();
        $inputs = $request->validate(Vehicle::$rules);
        $inputs['company_id'] = $company->id;
        $inputs['status'] = $company->status;

        $vehicle = Vehicle::create($inputs);

        foreach ($request->vehicle_photos as $photo) {
            VehiclePhotos::create([
                'vehicle_id' => $vehicle->id,
                'photo'      => $photo
            ]);
        }

        $vehicle->load('photos', 'brand', 'model', 'type', 'service', 'company');

        return response()->json(compact('vehicle'));
    }

    public function vehicle_update(Request $request, $id)
    {
        $company = auth('api.company')->user();

        $vehicle = Vehicle::where('company_id', $company->id)
            ->where('id', $id)
            ->first();

        if (empty($vehicle)) {
            return response()->json(['msg' => 'The vehicle is not found, Please check your data'], 403);
        }

        $inputs = $request->validate([

            'company_id' => 'nullable',
            'brand_id' => 'required',
            'service_id' => 'required',
            'brand_id' => 'required',
            'model_id' => 'required',
            'vehicle_type_id' => 'required',
            'model_year' => 'required',
            'engine_serial_number' => 'required|unique:vehicles,engine_serial_number,' . $vehicle->id,
            'chassis_number' => 'required|unique:vehicles,chassis_number,' . $vehicle->id,
            'license_plate' => 'required|string|max:191|unique:vehicles,license_plate,' . $vehicle->id,
            'front_vehicle_license' => 'nullable|image|mimes:jpeg,jpg,png',
            'back_vehicle_license' => 'nullable|image|mimes:jpeg,jpg,png',
            'technical_report' => 'nullable|image|mimes:jpeg,jpg,png',

            'vehicle_photos' => 'nullable|array',
            'vehicle_photos.*' => 'nullable|image|mimes:jpeg,jpg,png',
        ]);

        $vehicle->update($inputs);

        if ($request->vehicle_photos) {
            VehiclePhotos::where('vehicle_id', $vehicle->id)->delete();

            foreach ($request->vehicle_photos as $photo) {
                VehiclePhotos::create([
                    'vehicle_id' => $vehicle->id,
                    'photo'      => $photo
                ]);
            }
        }

        $vehicle->load('photos');

        return response()->json(compact('vehicle'));
    }

    public function vehicle_delete($id)
    {
        $company = auth('api.company')->user();

        $vehicle = Vehicle::where('company_id', $company->id)
            ->where('id', $id)
            ->first();

        if (empty($vehicle)) {
            return response()->json(['msg' => 'The vehicle is not found, Please check your data'], 403);
        }

        $vehicle->delete();

        return response()->json(['msg' => __('messages.deleted', ['model' => __('models/vehicles.singular')])]);
    }

    //------------------------ End Vehicles ------------------------//



    ##################################################################
    # Trips
    ##################################################################

    public function trips()
    {
        $drivers = Driver::where('company_id', auth('api.company')->id())->get();
        $tripsQuery = Trip::whereIn('driver_id', $drivers->pluck('id')->toArray());

        $from = request()->filled('from') ? request('from') : '2000-5-22';
        $to = request()->filled('to') ? request('to') : now();
        if (request()->filled('from') || request()->filled('to')) {

            $tripsQuery->whereBetween('created_at', [$from, $to]);
        }

        $trips = $tripsQuery->latest()->with('driver')->paginate(10);

        return response()->json(compact('drivers', 'trips'));
    }

    public function trips_by_driver($id)
    {
        $driver = Driver::where('company_id', auth('api.company')->id())->where('id', $id)->get();
        $tripsQuery = Trip::whereIn('driver_id', $driver->pluck('id')->toArray());

        $from = request()->filled('from') ? request('from') : '2000-5-22';
        $to = request()->filled('to') ? request('to') : now();

        if (request()->filled('from') || request()->filled('to')) {

            $tripsQuery->whereBetween('created_at', [$from, $to]);
        }

        $trips = $tripsQuery->latest()->with('driver')->paginate(10);

        return response()->json(compact('driver', 'trips'));
    }

    public function trips_by_vehicle($id)
    {
        $vehicle = Vehicle::where('company_id', auth('api.company')->id())->where('id', $id)->get();
        $tripsQuery = Trip::whereIn('vehicle_id', $vehicle->pluck('id')->toArray());

        $from = request()->filled('from') ? request('from') : '2000-01-01';
        $to = request()->filled('to') ? request('to') : now();

        if (request()->filled('from') || request()->filled('to')) {

            $tripsQuery->whereBetween('created_at', [$from, $to]);
        }

        $trips = $tripsQuery->latest()->with('vehicle')->paginate(10);

        return response()->json(compact('vehicle', 'trips'));
    }

    //------------------------- End Trips --------------------------//

}
