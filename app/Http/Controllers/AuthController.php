<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\RegisterMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function forgot()
    {
        return view('auth.forgot');
    }

    public function reset($token)
    {
        $user = User::where('remember_token', '=', $token)->first();
        if(!empty($user))
        {
            $data['user'] = $user;
        return view('auth.reset',  $data);
        }
        else
        {
            abort(404);
        }

    }

    public function post_reset($token, Request $request)
    {
        $user = User::where('remember_token', '=', $token)->first();
        if(!empty($user))
        {
            if($request->password == $request->cpassword)
            {
                $user->passowrd = Hash::make($request->password);
                if(empty($user->email_verified_at))
                {
                $user->email_verified_at = date('Y-m-d H:i:s');
                }
                $user->remember_token = Str::random(40);
                $user->save();

                return redirect('login')->with('success', "Password successfully reset");
            }
            else
            {
                return redirect()->back()->with('error', "Password and confirm password doesn't match");
            }
        }
        else
        {
            abort(404);
        }
    }


    public function forgot_password(Request $request)
    {
        $user = User::where('email', '=', $request->email)->first();
        if(!empty($user))
        {
            $user->remember_token = Str::random(40);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', "Please check your email and reset your password");
        }
        else
        {
            return redirect()->back()->with('error', "Email not found");
        }
    }

    public function auth_login(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember))
        {
            if(!empty(Auth::user()->email_verified_at))
            {
                return redirect('panel/dashboard');
            }
            else
            {
                $user_id = Auth::user()->id;  //new variable ones they logged in they will get the id (user)
                Auth::logout();

                $get = User::getSingle($user_id);
                $get->remember_token = Str::random(40);
                $get->save();

                Mail::to($get->email)->send(new RegisterMail($get));

                return redirect()->back()->with('success', "Please Verify first your email address");
            }

        }
        else
        {
            return redirect()->back()->with('error', "Please enter correct email and password");
        }
    }

    public function create(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $get = new User;
        $get->name = trim($request->name);
        $get->email = trim($request->email);
        $get->password = Hash::make($request->password);
        $get->remember_token = Str::random(40);
        $get->save();

        Mail::to($get->email)->send(new RegisterMail($get));

        return redirect('login')->with('success', "Your account has register successfully and verify your email address");
    }

    public function verify($token)
    {
        $user = User::where('remember_token', '=', $token)->first();
        if(!empty($user))
        {
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->remember_token = Str::random(40);
            $user->save();

            return redirect('login')->with('success', "Your account has register successfully Verified");
        }
        else
        {
            abort(404);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
