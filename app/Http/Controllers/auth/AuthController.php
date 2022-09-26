<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    function register(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'email' => 'required|email|string|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ]
        ];
        if (App::currentLocale() == 'ru') {
            array_push($rules, [
                'otchestvo' => 'required|string|max:100'
            ]);
        }
        $data = $request->validate($rules);

        $userData = [
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'email_confirmation_token' => sha1(time()),
            'role' => 'user',
            'active' => 0,
            'password' => bcrypt($data['password'])
        ];
        if (App::currentLocale() == 'ru') {
            array_push($userData, ['otchestvo' => $data['otchestvo']]);
        }

        /**@var User $user */
        $user = User::create($userData);

        //$token = $user->createToken('main')->plainTextToken;

        Mail::send('mail.registration', ['user' => $user], function ($message) use ($user) {
            $message->to($user->email, $user->name . ' ' . $user->lastname)
                ->subject(__('auth.registration_subject'));
            $message->from('noreply@latido.ru', 'Latido Team');
        });

        return response([
            'registered' => true,
//            'token' => $token
        ]);
    }

    function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|string|unique:users,email',
            'password' => [
                'required',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ]
        ]);

        $remember = $credentials['remember'] ?? false;
        if (!Auth::attempt($credentials, $remember)) {
            return response([
                'error' => __('The provided credentials are not correct.')
            ], 422);
        }
        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;
    }

    function logout()
    {
        /**@var User $user */
        $user = Auth::user();
        //Revoque the authenticated user
        $user->currentAccessToken()->delete();
        return response([
            'success' => true
        ]);
    }

    function email(Request $request)
    {
        $emails = User::where(['email' => $request->email])->first();
        return response(['result' => $emails]);
    }

    function confirm_code(Request $request, $code = null)
    {
        $message = '';
        $result = false;
        if ($code) {
            $user = User::where([
                ['email_confirmation_token', '=', $code],
                ['active', '=', 0]
            ])->first();
            if (!empty($user)) {
                $date = Carbon::now();
                $created = Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at);
                if ($date->diffInHours($created) > 24) {
                    $message = __('auth.accode_expired');
                } else {
                    $user->active = 1;
                    $user->email_confirmation_token = $user->email_confirmation_token.'-old';
                    $user->save();
                }
            }
        } else {
            return redirect('/', 301);
        }
        return view("auth.confirmed", ['res' => 'false', 'message' => $message]);
    }

    function resend_email(Request $request){
        if(isset($request->email)){
            $user = User::where(['email'=>$request->email, 'active' => $request->active])->first();
            if(!empty($user)){
                Mail::send('mail.registration', ['user' => $user], function ($message) use ($user) {
                    $message->to($user->email, $user->name . ' ' . $user->lastname)
                        ->subject(__('auth.registration_subject'));
                    $message->from('noreply@latido.ru', 'Latido Team');
                });
                return response()->json(['res' => true]);
            }
            return response()->json(['res' => false, 'message' => __('auth.email_not_found')]);
        }
        return response()->json(['res' => false, 'message' => __('auth.email_not_provided')]);
    }
}
