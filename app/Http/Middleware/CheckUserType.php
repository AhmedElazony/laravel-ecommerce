<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$userTypes): Response
    {
        $user = request()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        if (!in_array($user->type, $userTypes)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
