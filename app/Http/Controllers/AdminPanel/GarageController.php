<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateGarageRequest;
use App\Http\Requests\AdminPanel\UpdateGarageRequest;
use App\Repositories\AdminPanel\GarageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class GarageController extends AppBaseController
{
    /** @var  GarageRepository */
    private $garageRepository;

    public function __construct(GarageRepository $garageRepo)
    {
        $this->garageRepository = $garageRepo;
    }

    /**
     * Display a listing of the Garage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $garages = $this->garageRepository->all();

        return view('adminPanel.garages.index')
            ->with('garages', $garages);
    }

    /**
     * Show the form for creating a new Garage.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.garages.create');
    }

    /**
     * Store a newly created Garage in storage.
     *
     * @param CreateGarageRequest $request
     *
     * @return Response
     */
    public function store(CreateGarageRequest $request)
    {
        $input = $request->all();

        $garage = $this->garageRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/garages.singular')]));

        return redirect(route('adminPanel.garages.index'));
    }

    /**
     * Display the specified Garage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $garage = $this->garageRepository->find($id);

        if (empty($garage)) {
            Flash::error(__('messages.not_found', ['model' => __('models/garages.singular')]));

            return redirect(route('adminPanel.garages.index'));
        }

        return view('adminPanel.garages.show')->with('garage', $garage);
    }

    /**
     * Show the form for editing the specified Garage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $garage = $this->garageRepository->find($id);

        if (empty($garage)) {
            Flash::error(__('messages.not_found', ['model' => __('models/garages.singular')]));

            return redirect(route('adminPanel.garages.index'));
        }

        return view('adminPanel.garages.edit')->with('garage', $garage);
    }

    /**
     * Update the specified Garage in storage.
     *
     * @param int $id
     * @param UpdateGarageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGarageRequest $request)
    {
        $garage = $this->garageRepository->find($id);

        if (empty($garage)) {
            Flash::error(__('messages.not_found', ['model' => __('models/garages.singular')]));

            return redirect(route('adminPanel.garages.index'));
        }

        $garage = $this->garageRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/garages.singular')]));

        return redirect(route('adminPanel.garages.index'));
    }

    /**
     * Remove the specified Garage from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $garage = $this->garageRepository->find($id);

        if (empty($garage)) {
            Flash::error(__('messages.not_found', ['model' => __('models/garages.singular')]));

            return redirect(route('adminPanel.garages.index'));
        }

        $this->garageRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/garages.singular')]));

        return redirect(route('adminPanel.garages.index'));
    }
}
