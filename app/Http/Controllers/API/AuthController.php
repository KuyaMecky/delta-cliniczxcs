<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends AppBaseController
{

    /**
     * @param Request $request
     *
     *
     * @return mixed
     */
    public function login(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');


        if (empty($email) or empty($password)) {
            return $this->sendError('username and password required', 422);
        }
        $user = User::whereRaw('lower(email) = ?', [$email])->first();

        if (empty($user)) {
            return $this->sendError('Invalid username or password', 422);
        }

        if (!Hash::check($password, $user->password)) {
            return $this->sendError('Invalid username or password', 422);
        }
        if (!$user->hasRole(['Patient'])) {
            return $this->sendError('Invalid username or password', 422);
        }

        $token = $user->createToken('token')->plainTextToken;
        $user->last_name = $user->last_name ?? '';
        
        $data = [
            'token' => $token,
            'user'  => $user->prepareData(),
        ];
        return $this->sendResponse($data, 'Logged in successfully.');
    }


    /**
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->user()->tokens()->where('id', Auth::user()->currentAccessToken()->id)->delete();

        return $this->sendSuccess('Logout Successfully');
    }

    /**
     * @param Request $request
     *
     * @throws ValidationException
     *
     * @return JsonResponse
     */
    public function sendPasswordResetLinkEmail(Request $request): JsonResponse
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );
        $user = User::whereEmail($request->email)->first();
        if (!$user) {
            return $this->sendError('We can\'t find a user with that e-mail address.');
        }

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => __($status)], 200);
        } else {
            throw ValidationException::withMessages([
                'email' => "Please Wait Before Trying",
            ]);
        }
    }

    /**
     * @param Request $request
     *
     * @throws ValidationException
     *
     * @return JsonResponse
     */
    public function resetPassword(Request $request): JsonResponse
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response()->json(['message' => __($status)], 200);
        } else {
            throw ValidationException::withMessages([
                'email' => __($status),
            ]);
        }
    }
}
