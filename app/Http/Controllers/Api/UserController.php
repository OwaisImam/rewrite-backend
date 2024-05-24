<?php

namespace App\Http\Controllers\Api;

use App\Helper\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private Request $request;
    private User $user;
    private UserRepository $userRepository;

    public function __construct(Request $request, UserRepository $userRepository)
    {
        $this->request = $request;
        $this->userRepository = $userRepository;

        $this->user = Auth::guard('api')->user();
    }

    public function updateNotificationStatus()
    {
        try{
            DB::beginTransaction();

            $validator = Validator::make($this->request->all(), [
                'is_notification_on' => 'required|boolean'
            ]);

            if ($validator->fails()) {
                return JsonResponse::validationFail([$validator->errors()], 422);
            }

            /** @var User $user */
            $user = $this->userRepository->updateById($this->user->id, [
                'is_notification_on' => $this->request->is_notification_on
            ]);

            DB::commit();

            return JsonResponse::success($user,'Status updated successfully.');
        }catch(\Exception $e) {
            DB::rollback();
            Log::debug($e);
            return JsonResponse::fail('Something went wrong');
        }
    }
}