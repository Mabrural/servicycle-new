<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // NORMALISASI NOMOR HP
        $phone = $this->normalizePhone($request->phone);

        // VALIDASI SETELAH NORMALISASI (IMPORTANT!)
        if (User::where('phone', $phone)->exists()) {
            return back()->withErrors([
                'phone' => 'Nomor HP sudah terdaftar.',
            ])->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $phone, // selalu 628xxxx
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
    private function normalizePhone(string $phone): string
    {
        // Hapus spasi, strip, tanda dll
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Jika diawali 0 → ganti jadi 62
        if (str_starts_with($phone, '0')) {
            return '62' . substr($phone, 1);
        }

        // Jika diawali +62 → jadi 62
        if (str_starts_with($phone, '62')) {
            return $phone;
        }

        // Jika user input 8xxxx → jadikan 62xxxx
        if (str_starts_with($phone, '8')) {
            return '62' . $phone;
        }

        return $phone;
    }


    public function registerMitra(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // NORMALISASI NOMOR HP
        $phone = $this->normalizePhone($request->phone);

        // VALIDASI SETELAH NORMALISASI (IMPORTANT!)
        if (User::where('phone', $phone)->exists()) {
            return back()->withErrors([
                'phone' => 'Nomor HP sudah terdaftar.',
            ])->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $phone, // selalu 628xxxx
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mitra',
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
