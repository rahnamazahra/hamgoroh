<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function configLogin(LoginRequest $request): RedirectResponse
    {
        $phone = $request->input('phone');
        // $code  = mt_rand(111111, 999999);    // Generate code
        $code = 123456;
        $user  = User::where('phone', $phone)->update(['password' => Hash::make($code)]);   // Save code in database
        // $this->sendCode($phone, $code);  // Send SMS
        Alert('success', 'کدپیامکی برای شما ارسال شد.');

        return redirect()->route('verify.show', ['phone' => $phone]);
    }

    public function showVerify($phone): View
    {
        return view('auth.verify', ['phone' => $phone]);
    }

    public function configVerify(Request $request): RedirectResponse
    {
        $credentials = $request->only('phone', 'password');
        if (Auth::attempt($credentials))
        {
            $user = Auth::user();
            $request->session()->regenerate();

            if ($user->roles->contains(1) OR $user->roles->contains(2))
            {
                Alert('success', 'خوش آمدید');
                return redirect()->intended(RouteServiceProvider::ADMIN);
            }

            if ($user->roles->contains(3))
            {
                Alert('success', 'خوش آمدید');
                return redirect()->intended(RouteServiceProvider::GENERALMANAGER);
            }

            if ($user->roles->contains(4))
            {
                Alert('success', 'خوش آمدید');
                return redirect()->intended(RouteServiceProvider::PROVINCIALMANAGER);
            }

            return redirect()->intended(RouteServiceProvider::SITE);
        }

        Alert('error',  'کد فعال سازی وارد شده اشتباه است.');

        return redirect()->route('verify.show', ['phone' => $request->phone]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
        // return redirect()->intended(RouteServiceProvider::MAIN);
    }

    private function sendCode($receiver, $code)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.datees.net/sms/sms.php?pattern=w4t78v73puhstvy&projectid=90&recipient='.$receiver.'&vars[code]='.$code);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
    }
}
