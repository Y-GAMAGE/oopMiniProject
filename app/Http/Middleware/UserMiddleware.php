<?php


namespace App\Http\Middleware;

use App\Services\UserService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to continue.');
        }

        $user = Auth::user();
        $userInstance = $this->userService->getUserInstance($user);

        if ($userInstance->getRole() !== 'user' || !$userInstance->isActive()) {
            Auth::logout();
            return redirect()->route('login')
                ->with('error', 'Access denied or account inactive.');
        }

        return $next($request);
    }
}
