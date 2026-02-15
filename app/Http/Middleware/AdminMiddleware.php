<?php


namespace App\Http\Middleware;

use App\Services\UserService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
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
                ->with('error', 'Please login as admin to continue.');
        }

        $user = Auth::user();
        $userInstance = $this->userService->getUserInstance($user);

        if (!$userInstance->canAccessAdminPanel() || !$userInstance->isActive()) {
            return redirect()->route('home')
                ->with('error', 'Access denied. Admin privileges required.');
        }

        return $next($request);
    }
}
