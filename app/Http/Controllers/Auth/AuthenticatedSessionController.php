<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Role;

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

        return redirect()->route('verify.show', ['phone' => $phone]);
    }

    public function showVerify($phone): View
    {
        return view('auth.verify', ['phone' => $phone]);
    }

    public function configVerify(Request $request): RedirectResponse
    {
        $user = User::where('phone', $request->input('phone'))->first();

        if (Hash::check($request->input('password'), $user->password))
        {
            $request->session()->regenerate();

            if ($user->roles->contains(2))
            {
                Auth::loginUsingId($user->id);
                return redirect()->intended(RouteServiceProvider::ADMIN);
            }

            return redirect()->intended(RouteServiceProvider::SITE);
        }

        return redirect()->route('verify.show', ['phone' => $user->phone])->with('wrong_code', 'کد فعال سازی وارد شده اشتباه است.');
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
