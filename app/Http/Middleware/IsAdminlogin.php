<?php
namespace App\Http\Middleware;

class IsAdminlogin
{
    public function handle($request, \Closure $next)
    {
        if (\Session::has("adminid")) {
            return $next($request);
        }
        return redirect("/admin/admins/login");
    }
}

?>