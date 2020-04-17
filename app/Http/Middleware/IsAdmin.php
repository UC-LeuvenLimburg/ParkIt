<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $admin = $this->isAdmin(auth()->user());
        if ($admin) {
            return $next($request);
        }
        return redirect('/');
    }

    private function isAdmin($user)
    {
        return $user->isAdmin();
    }
}
