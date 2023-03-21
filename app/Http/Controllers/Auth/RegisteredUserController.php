<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['string', 'max:255', 'nullable'],
            'surname' => ['string', 'max:255', 'nullable'],
            'date_of_birth' => ['date', 'nullable' ],
            'profile_image' => ['image', 'nullable'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $data = $request->all();
        $user = User::create([
            'name' => $request->name ?? null,
            'surname' => $request->surname ?? null,
            'date_of_birth' => $request->date_of_birth ?? null,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (key_exists("profile_image", $data)) {
            $path = Storage::put("profile_images", $request->profile_image);
            $user->profile_image = $path;
            $user->save();
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
