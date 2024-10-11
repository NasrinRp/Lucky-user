<?php

namespace App\Http\Controllers;

use App\Jobs\RewardToUserJob;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LuckyUserController extends Controller
{
    /**
     * Handle the request to reward a lucky user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function rewardToUser(Request $request): JsonResponse
    {
        $amount = $this->validateRequest($request);

        $user = User::query()->inRandomOrder()->first();

        RewardToUserJob::dispatch($user, $amount)->onQueue('reward');

        return response()->json(['message' => "$amount$ given to a lucky user and an email sent."]);
    }

    /**
     * Validate the incoming request.
     *
     * @param Request $request
     * @return int
     */
    protected function validateRequest(Request $request): int
    {
        return $request->validate([
            'amount' => 'required|integer|gt:0',
        ])['amount'];
    }
}
