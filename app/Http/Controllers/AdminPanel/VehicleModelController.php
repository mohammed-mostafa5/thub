<?php

namespace App\Http\Controllers\AdminPanel;

use Flash;
use Response;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AdminPanel\VehicleModelRepository;
use App\Http\Requests\AdminPanel\CreateVehicleModelRequest;
use App\Http\Requests\AdminPanel\UpdateVehicleModelRequest;
use App\Models\VehicleModel;

class VehicleModelController extends AppBaseController
{
    /** @var  VehicleModelRepository */
    private $vehicleModelRepository;

    public function __construct(VehicleModelRepository $vehicleModelRepo)
    {
        $this->vehicleModelRepository = $vehicleModelRepo;
    }

    /**
     * Display a listing of the VehicleModel.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Brand $brand)
    {
        $vehicleModels = VehicleModel::where('brand_id', $brand->id)->get();

        return view('adminPanel.vehicle_models.index', compact('brand', 'vehicleModels'));
    }

    /**
     * Show the form for creating a new VehicleModel.
     *
     * @return Response
     */
    public function create(Brand $brand)
    {
        return view('adminPanel.vehicle_models.create', compact('brand'));
    }

    /**
     * Store a newly created VehicleModel in storage.
     *
     * @param CreateVehicleModelRequest $request
     *
     * @return Response
     */
    public function store(CreateVehicleModelRequest $request, Brand $brand)
    {
        $input = $request->all();
        $input['brand_id'] = $brand->id;


        $vehicleModel = $this->vehicleModelRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/vehicleModels.singular')]));

        return redirect(route('adminPanel.brands.vehicleModels.index', $brand->id));
    }

    /**
     * Display the specified VehicleModel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vehicleModel = $this->vehicleModelRepository->find($id);

        if (empty($vehicleModel)) {
            Flash::error(__('messages.not_found', ['model' => __('models/vehicleModels.singular')]));

            return redirect(route('adminPanel.vehicleModels.index'));
        }

        return view('adminPanel.vehicle_models.show')->with('vehicleModel', $vehicleModel);
    }

    /**
     * Show the form for editing the specified VehicleModel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, Brand $brand)
    {
        $vehicleModel = $this->vehicleModelRepository->find($id);

        if (empty($vehicleModel)) {
            Flash::error(__('messages.not_found', ['model' => __('models/vehicleModels.singular')]));

            return redirect(route('adminPanel.brands.vehicleModels.index', $brand->id));
        }

        return view('adminPanel.vehicle_models.edit', compact('brand', 'vehicleModel'));
    }

    /**
     * Update the specified VehicleModel in storage.
     *
     * @param int $id
     * @param UpdateVehicleModelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVehicleModelRequest $request)
    {
        $vehicleModel = $this->vehicleModelRepository->find($id);

        if (empty($vehicleModel)) {
            Flash::error(__('messages.not_found', ['model' => __('models/vehicleModels.singular')]));

            return redirect(route('adminPanel.vehicleModels.index'));
        }

        $vehicleModel = $this->vehicleModelRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/vehicleModels.singular')]));

        return redirect(route('adminPanel.brands.vehicleModels.index', $vehicleModel->brand_id));
    }

    /**
     * Remove the specified VehicleModel from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $vehicleModel = $this->vehicleModelRepository->find($id);

        if (empty($vehicleModel)) {
            Flash::error(__('messages.not_found', ['model' => __('models/vehicleModels.singular')]));

            return redirect(route('adminPanel.vehicleModels.index'));
        }

        $this->vehicleModelRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/vehicleModels.singular')]));

        return redirect(route('adminPanel.brands.vehicleModels.index', $vehicleModel->brand_id));
    }
}
