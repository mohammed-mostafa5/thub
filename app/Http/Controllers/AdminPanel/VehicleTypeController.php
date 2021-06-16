<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateVehicleTypeRequest;
use App\Http\Requests\AdminPanel\UpdateVehicleTypeRequest;
use App\Repositories\AdminPanel\VehicleTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class VehicleTypeController extends AppBaseController
{
    /** @var  VehicleTypeRepository */
    private $vehicleTypeRepository;

    public function __construct(VehicleTypeRepository $vehicleTypeRepo)
    {
        $this->vehicleTypeRepository = $vehicleTypeRepo;
    }

    /**
     * Display a listing of the VehicleType.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $vehicleTypes = $this->vehicleTypeRepository->all();

        return view('adminPanel.vehicle_types.index')
            ->with('vehicleTypes', $vehicleTypes);
    }

    /**
     * Show the form for creating a new VehicleType.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.vehicle_types.create');
    }

    /**
     * Store a newly created VehicleType in storage.
     *
     * @param CreateVehicleTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateVehicleTypeRequest $request)
    {
        $input = $request->all();

        $vehicleType = $this->vehicleTypeRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/vehicleTypes.singular')]));

        return redirect(route('adminPanel.vehicleTypes.index'));
    }

    /**
     * Display the specified VehicleType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vehicleType = $this->vehicleTypeRepository->find($id);

        if (empty($vehicleType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/vehicleTypes.singular')]));

            return redirect(route('adminPanel.vehicleTypes.index'));
        }

        return view('adminPanel.vehicle_types.show')->with('vehicleType', $vehicleType);
    }

    /**
     * Show the form for editing the specified VehicleType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $vehicleType = $this->vehicleTypeRepository->find($id);

        if (empty($vehicleType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/vehicleTypes.singular')]));

            return redirect(route('adminPanel.vehicleTypes.index'));
        }

        return view('adminPanel.vehicle_types.edit')->with('vehicleType', $vehicleType);
    }

    /**
     * Update the specified VehicleType in storage.
     *
     * @param int $id
     * @param UpdateVehicleTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVehicleTypeRequest $request)
    {
        $vehicleType = $this->vehicleTypeRepository->find($id);

        if (empty($vehicleType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/vehicleTypes.singular')]));

            return redirect(route('adminPanel.vehicleTypes.index'));
        }

        $vehicleType = $this->vehicleTypeRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/vehicleTypes.singular')]));

        return redirect(route('adminPanel.vehicleTypes.index'));
    }

    /**
     * Remove the specified VehicleType from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $vehicleType = $this->vehicleTypeRepository->find($id);

        if (empty($vehicleType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/vehicleTypes.singular')]));

            return redirect(route('adminPanel.vehicleTypes.index'));
        }

        $this->vehicleTypeRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/vehicleTypes.singular')]));

        return redirect(route('adminPanel.vehicleTypes.index'));
    }
}
