<?php

namespace App\Http\Controllers\Api;

use App\Helper\Helper;
use App\Helper\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    private Request $request;
    private User $user;
    private UserRepository $userRepository;

    public function __construct(Request $request, UserRepository $userRepository)
    {
        $this->request = $request;
        $this->userRepository = $userRepository;
    }

    public function register()
    {
        try {
            DB::beginTransaction();

             $validator = Validator::make($this->request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return JsonResponse::validationFail([$validator->errors()], 422);
            }

            $user = User::create([
                'name' => $this->request->name,
                'email' => $this->request->email,
                'password' => Hash::make($this->request->password),
            ]);


            $token = JWTAuth::fromUser($user);

            DB::commit();
            return Helper::respondWithToken('User registered successfully', $token, $user);
        }catch(\Exception $e)
        {
            Log::debug($e);
            DB::rollback();
            return JsonResponse::fail('Something went wrong');
        }

    }

    public function profile()
    {
        $user = Auth::guard('api')->user();

        if($user) {
            return JsonResponse::success($user, 'Profile fetched successfully.');
        }
        return JsonResponse::fail('User not logged in');
    }

    public function login()
    {
         $validator = Validator::make($this->request->all(), [
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return JsonResponse::validationFail([$validator->errors()], 422);
        }

        $user = User::where('email', $this->request->email)->first();

        if (!$user || !Hash::check($this->request->password, $user->password)) {
            return JsonResponse::fail('Invalid credentials', 401);
        }

        $token = JWTAuth::fromUser($user);
        return Helper::respondWithToken('User Login successfully', $token, $user);
    }

    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return JsonResponse::validationFail([$validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();
        $otp = rand(100000, 999999);

        $user->otp = $otp;
        $user->otp_expiration = Carbon::now()->addMinutes(10); // OTP valid for 10 minutes
        $user->save();

        // Send OTP via email (or SMS if needed)
        Mail::raw("Your OTP for password reset is: $otp", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Password Reset OTP');
        });

        return JsonResponse::success('OTP sent successfully.');
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return JsonResponse::validationFail([$validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();

        if ($user->otp !== $request->otp) {
            return JsonResponse::fail('Invalid OTP.', 400);
        }

        if (Carbon::now()->greaterThan($user->otp_expiration)) {
            return JsonResponse::fail('OTP has expired.', 400);
        }

        return JsonResponse::success('OTP verified successfully.');
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return JsonResponse::validationFail([$validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();

        if ($user->otp !== $request->otp) {
            return JsonResponse::fail('Invalid OTP.', 400);
        }

        if (Carbon::now()->greaterThan($user->otp_expiration)) {
            return JsonResponse::fail('OTP has expired.', 400);
        }

        $user->password = Hash::make($request->password);
        $user->otp = null;
        $user->otp_expiration = null;
        $user->save();

        return  JsonResponse::success('Password reset successfully.');
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::parseToken());
            return  JsonResponse::success('User successfully logged out');
        } catch (JWTException $exception) {
            return JsonResponse::fail('Sorry, the user cannot be logged out');
        }
    }
}