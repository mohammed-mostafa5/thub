<?php

namespace App\Http\Controllers\AdminPanel;

use Flash;
use Response;
use Illuminate\Http\Request;
use App\Events\NotificationPusher;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AdminPanel\RewardRepository;
use App\Http\Requests\AdminPanel\CreateRewardRequest;
use App\Http\Requests\AdminPanel\UpdateRewardRequest;

class RewardController extends AppBaseController
{
    /** @var  RewardRepository */
    private $rewardRepository;

    public function __construct(RewardRepository $rewardRepo)
    {
        $this->rewardRepository = $rewardRepo;
    }

    /**
     * Display a listing of the Reward.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $rewards = $this->rewardRepository->paginate(10);

        return view('adminPanel.rewards.index')
            ->with('rewards', $rewards);
    }

    /**
     * Show the form for creating a new Reward.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.rewards.create');
    }

    /**
     * Store a newly created Reward in storage.
     *
     * @param CreateRewardRequest $request
     *
     * @return Response
     */
    public function store(CreateRewardRequest $request)
    {
        $input = $request->all();

        $reward = $this->rewardRepository->create($input);

        event(new NotificationPusher(['send_to' => $reward->discount_to, 'data' => $reward, 'type' => 'reward']));

        Flash::success(__('messages.saved', ['model' => __('models/rewards.singular')]));


        return redirect(route('adminPanel.rewards.index'));
    }

    /**
     * Display the specified Reward.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $reward = $this->rewardRepository->find($id);

        if (empty($reward)) {
            Flash::error(__('messages.not_found', ['model' => __('models/rewards.singular')]));

            return redirect(route('adminPanel.rewards.index'));
        }

        return view('adminPanel.rewards.show')->with('reward', $reward);
    }

    /**
     * Show the form for editing the specified Reward.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $reward = $this->rewardRepository->find($id);

        if (empty($reward)) {
            Flash::error(__('messages.not_found', ['model' => __('models/rewards.singular')]));

            return redirect(route('adminPanel.rewards.index'));
        }

        return view('adminPanel.rewards.edit')->with('reward', $reward);
    }

    /**
     * Update the specified Reward in storage.
     *
     * @param int $id
     * @param UpdateRewardRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRewardRequest $request)
    {
        $reward = $this->rewardRepository->find($id);

        if (empty($reward)) {
            Flash::error(__('messages.not_found', ['model' => __('models/rewards.singular')]));

            return redirect(route('adminPanel.rewards.index'));
        }

        $reward = $this->rewardRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/rewards.singular')]));

        return redirect(route('adminPanel.rewards.index'));
    }

    /**
     * Remove the specified Reward from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $reward = $this->rewardRepository->find($id);

        if (empty($reward)) {
            Flash::error(__('messages.not_found', ['model' => __('models/rewards.singular')]));

            return redirect(route('adminPanel.rewards.index'));
        }

        $this->rewardRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/rewards.singular')]));

        return redirect(route('adminPanel.rewards.index'));
    }
}
