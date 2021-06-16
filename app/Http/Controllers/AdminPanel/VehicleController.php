<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateVehicleRequest;
use App\Http\Requests\AdminPanel\UpdateVehicleRequest;
use App\Repositories\AdminPanel\VehicleRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Category;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Flash;
use Response;

class VehicleController extends AppBaseController
{
    /** @var  vehicleRepository */
    private $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepo)
    {
        $this->vehicleRepository = $vehicleRepo;
    }

    public function index(Request $request)
    {
        $vehicles = $this->vehicleRepository->paginate(10);

        return view('adminPanel.vehicles.index')
            ->with('vehicles', $vehicles);
    }


    public function show($id)
    {
        $data['vehicle'] = $vehicle = Vehicle::find($id);

        if (empty($vehicle)) {
            Flash::error(__('messages.not_found', ['model' => __('models/vehicles.singular')]));

            return redirect(route('adminPanel.vehicles.index'));
        }
        $data['categories'] = $categories = Category::where('service_id', $vehicle->service_id)->active()->get();

        return view('adminPanel.vehicles.show', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate(['category_id' => 'required']);

        $vehicle = Vehicle::find($id);

        if (empty($vehicle)) {
            Flash::error(__('messages.not_found', ['model' => __('models/vehicles.singular')]));

            return redirect(route('adminPanel.vehicles.index'));
        }

        $vehicle->update(['category_id' => $request->category_id]);

        Flash::success(__('messages.updated', ['model' => __('models/vehicles.singular')]));

        return redirect(route('adminPanel.vehicles.index'));
    }

    public function approve($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update(['status' => 1]);

        return back();
    }
}
