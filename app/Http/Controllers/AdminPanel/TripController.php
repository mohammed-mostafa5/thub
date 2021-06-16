<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateTripRequest;
use App\Http\Requests\AdminPanel\UpdateTripRequest;
use App\Repositories\AdminPanel\TripRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TripController extends AppBaseController
{
    /** @var  TripRepository */
    private $tripRepository;

    public function __construct(TripRepository $tripRepo)
    {
        $this->tripRepository = $tripRepo;
    }

    /**
     * Display a listing of the Trip.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $trips = $this->tripRepository->all();

        return view('adminPanel.trips.index')
            ->with('trips', $trips);
    }

    /**
     * Show the form for creating a new Trip.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.trips.create');
    }

    /**
     * Store a newly created Trip in storage.
     *
     * @param CreateTripRequest $request
     *
     * @return Response
     */
    public function store(CreateTripRequest $request)
    {
        $input = $request->all();

        $trip = $this->tripRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/trips.singular')]));

        return redirect(route('adminPanel.trips.index'));
    }

    /**
     * Display the specified Trip.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $trip = $this->tripRepository->find($id);

        if (empty($trip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/trips.singular')]));

            return redirect(route('adminPanel.trips.index'));
        }

        return view('adminPanel.trips.show')->with('trip', $trip);
    }

    /**
     * Show the form for editing the specified Trip.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $trip = $this->tripRepository->find($id);

        if (empty($trip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/trips.singular')]));

            return redirect(route('adminPanel.trips.index'));
        }

        return view('adminPanel.trips.edit')->with('trip', $trip);
    }

    /**
     * Update the specified Trip in storage.
     *
     * @param int $id
     * @param UpdateTripRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTripRequest $request)
    {
        $trip = $this->tripRepository->find($id);

        if (empty($trip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/trips.singular')]));

            return redirect(route('adminPanel.trips.index'));
        }

        $trip = $this->tripRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/trips.singular')]));

        return redirect(route('adminPanel.trips.index'));
    }

    /**
     * Remove the specified Trip from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $trip = $this->tripRepository->find($id);

        if (empty($trip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/trips.singular')]));

            return redirect(route('adminPanel.trips.index'));
        }

        $this->tripRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/trips.singular')]));

        return redirect(route('adminPanel.trips.index'));
    }
}
