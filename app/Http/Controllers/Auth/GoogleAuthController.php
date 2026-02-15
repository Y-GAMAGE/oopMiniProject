<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'profile_picture' => $googleUser->getAvatar(),
                    'email_verified_at' => now(),
                ]);
            } else {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'profile_picture' => $googleUser->getAvatar(),
                    'email_verified_at' => now(),
                    'password' => bcrypt(Str::random(16)),
                    'role' => 'user',
                    'status' => 'active',
                ]);
            }

            Auth::login($user);

            $userInstance = $this->userService->getUserInstance($user);

            return redirect($userInstance->redirectAfterLogin())
                ->with('success', $this->userService->getWelcomeMessage($userInstance));

        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Unable to login with Google. Please try again.');
        }
    }
}
