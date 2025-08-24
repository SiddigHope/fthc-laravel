<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Trainee;
use App\Models\Role;
use App\Models\Country;
use App\Models\Specialization;
use App\Models\SubSpecialization;
use App\Models\Unclassified;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        $countries = Country::all();
        $specializations = Specialization::all();
        $subSpecializations = SubSpecialization::all();
        $unclassifieds = Unclassified::all();

        return view('auth.register', compact('countries', 'specializations', 'subSpecializations', 'unclassifieds'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'usrEmail' => ['required', 'email'],
            'usrPassword' => ['required'],
        ]);

        $authObject = [
            'usrEmail' => $request->usrEmail,
            'password' => $request->usrPassword,
        ];

        if (Auth::attempt($authObject)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('usrPassword'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'trnNameAr' => ['required', 'string', 'max:255'],
            'trnNameEn' => ['required', 'string', 'max:255'],
            'usrEmail' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'usrPassword' => ['required', 'confirmed', Password::min(8)],
            'trnGender' => ['required', 'boolean'],
            'cntId' => ['required', 'exists:lookup_countries,cntId'],
            'trnMobile' => ['required', 'string', 'max:20'],
            'trnWhatsapp' => ['required', 'string', 'max:20'],
            'trnIsSCFHS' => ['boolean'],
            'trnSCFHSNo' => ['required_if:trnIsSCFHS,1', 'nullable', 'string', 'max:255'],
            'spcId' => ['required', 'exists:lookup_specialization,spcId'],
            'spcSubId' => ['required', 'exists:lookup_sub_specialization,spcSubId'],
            'unclassId' => ['exists:lookup_unclassified,unclassId'],
            'trnJobTitle' => ['string', 'max:255'],
            'trnWorkplace' => ['string', 'max:255'],
        ]);

        $traineeRole = Role::where('rolNameEn', 'trainee')->first();

        // var_dump($request->all()); // Debugging line to check if the role is fetched correctly
        // var_dump($request->all()); // Debugging line to check if the role is fetched correctly
        $user = User::create([
            'usrEmail' => $request->usrEmail,
            'password' => Hash::make($request->usrPassword),
            'rolId' => $traineeRole->rolId,
            'usrStatus' => true,
            'usrMobile' => $request->trnMobile,
        ]);

        $trainee = new Trainee([
            'trnNameAr' => $request->trnNameAr,
            'trnNameEn' => $request->trnNameEn,
            'trnGender' => $request->trnGender,
            'cntId' => $request->cntId,
            'trnMobile' => $request->trnMobile,
            'trnWhatsapp' => $request->trnWhatsapp,
            'trnIsSCFHS' => $request->trnIsSCFHS,
            'trnSCFHSNo' => $request->trnSCFHSNo,
            'trnJobTitle' => $request->trnJobTitle,
            'trnWorkplace' => $request->trnWorkplace,
            'spcId' => $request->spcId,
            'spcSubId' => $request->spcSubId,
            'unclassId' => $request->unclassId,
        ]);

        $user->traineeProfile()->save($trainee);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
