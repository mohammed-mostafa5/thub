<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateReasonRequest;
use App\Http\Requests\AdminPanel\UpdateReasonRequest;
use App\Repositories\AdminPanel\ReasonRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ReasonController extends AppBaseController
{
    /** @var  ReasonRepository */
    private $reasonRepository;

    public function __construct(ReasonRepository $reasonRepo)
    {
        $this->reasonRepository = $reasonRepo;
    }

    /**
     * Display a listing of the Reason.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $reasons = $this->reasonRepository->all();

        return view('adminPanel.reasons.index')
            ->with('reasons', $reasons);
    }

    /**
     * Show the form for creating a new Reason.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.reasons.create');
    }

    /**
     * Store a newly created Reason in storage.
     *
     * @param CreateReasonRequest $request
     *
     * @return Response
     */
    public function store(CreateReasonRequest $request)
    {
        $input = $request->all();

        $reason = $this->reasonRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/reasons.singular')]));

        return redirect(route('adminPanel.reasons.index'));
    }

    /**
     * Display the specified Reason.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $reason = $this->reasonRepository->find($id);

        if (empty($reason)) {
            Flash::error(__('messages.not_found', ['model' => __('models/reasons.singular')]));

            return redirect(route('adminPanel.reasons.index'));
        }

        return view('adminPanel.reasons.show')->with('reason', $reason);
    }

    /**
     * Show the form for editing the specified Reason.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $reason = $this->reasonRepository->find($id);

        if (empty($reason)) {
            Flash::error(__('messages.not_found', ['model' => __('models/reasons.singular')]));

            return redirect(route('adminPanel.reasons.index'));
        }

        return view('adminPanel.reasons.edit')->with('reason', $reason);
    }

    /**
     * Update the specified Reason in storage.
     *
     * @param int $id
     * @param UpdateReasonRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReasonRequest $request)
    {
        $reason = $this->reasonRepository->find($id);

        if (empty($reason)) {
            Flash::error(__('messages.not_found', ['model' => __('models/reasons.singular')]));

            return redirect(route('adminPanel.reasons.index'));
        }

        $reason = $this->reasonRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/reasons.singular')]));

        return redirect(route('adminPanel.reasons.index'));
    }

    /**
     * Remove the specified Reason from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $reason = $this->reasonRepository->find($id);

        if (empty($reason)) {
            Flash::error(__('messages.not_found', ['model' => __('models/reasons.singular')]));

            return redirect(route('adminPanel.reasons.index'));
        }

        $this->reasonRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/reasons.singular')]));

        return redirect(route('adminPanel.reasons.index'));
    }
}
