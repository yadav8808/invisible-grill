<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {

                       $request->validate(
    [
        'email' => 'required|email',
        'password' => [
            'required',
            'string',
            'min:8', // minimum 8 characters
            //'regex:/[a-z]/',      // at least one lowercase letter
            //'regex:/[A-Z]/',      // at least one uppercase letter
            //'regex:/[0-9]/',      // at least one number
            //'regex:/[@$!%*#?&]/'  // at least one special character
        ],
        'captcha' => 'required|captcha',
    ],
    [
        // Email messages
        'email.required' => 'Email is required.',
        'email.email' => 'Please enter a valid email address.',

        // Password messages
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 8 characters.',
       // 'password.regex' => 'Password must include at least one uppercase letter, one lowercase letter, one number, and one special character (@$!%*#?&).',

        // Captcha messages
        'captcha.required' => 'Captcha is required.',
        'captcha.captcha' => 'Captcha does not match, please try again.',
    ]
);



			    $credentials = [
			        'email' => $request->input('email'),
			        'password' => $request->input('password'),
			    ];


                $email = $credentials['email'];
                $inputPassword = $credentials['password'];

                $user = User::where('email', $email)->first();

                if($user){
                    $decryptedPassword = hash_hmac(
                        'sha512',
                        $user->password,
                        $request->input('_token')
                    );
                    //  dd(
                    //     [
                    //     'input pass 2nd round ' => $inputPassword,
                    //     'decrypted db 2nd round' => $decryptedPassword,
                    //     'db_ pass ' => $user->password,
                    //         ]
                    //     );

                    if ($decryptedPassword === $inputPassword) {
                        Auth::login($user);

                         return redirect()->route('dashboard');

                    }

                }

			    return redirect()->back()->withErrors([
			        'login' => 'The provided credentials do not match our records.',
			    ])->withInput($request->only('email'));

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
