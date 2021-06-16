<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateDriverRequest;
use App\Http\Requests\AdminPanel\UpdateDriverRequest;
use App\Repositories\AdminPanel\DriverRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Driver;
use Illuminate\Http\Request;
use Flash;
use Response;

class DriverController extends AppBaseController
{
    /** @var  DriverRepository */
    private $driverRepository;

    public function __construct(DriverRepository $driverRepo)
    {
        $this->driverRepository = $driverRepo;
    }


    public function index(Request $request)
    {
        $drivers = $this->driverRepository->all();

        return view('adminPanel.drivers.index')
            ->with('drivers', $drivers);
    }

    public function show($id)
    {
        $driver = $this->driverRepository->find($id);

        if (empty($driver)) {
            Flash::error(__('messages.not_found', ['model' => __('models/drivers.singular')]));

            return redirect(route('adminPanel.drivers.index'));
        }

        return view('adminPanel.drivers.show')->with('driver', $driver);
    }

    public function approve(Driver $driver)
    {
        $driver->update(['status' => 2]);

        return back();
    }

    public function reject(Driver $driver)
    {
        $driver->update(['status' => 3]);

        return back();
    }

    public function deactivate(Driver $driver)
    {
        $driver->update(['status' => 4]);

        return back();
    }
}
