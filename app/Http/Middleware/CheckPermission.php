<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Admin;
use App\Models\Admin\Permission;
use Illuminate\Support\Facades\DB;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $modualName)
    {


        $user_id = session('UserSession.role_id');
        $data = DB::table('permissions')->where('modual', $modualName)->get('roll_ids');



        $roll_id =  session('UserSession.role_id');
        $roll_ids_array = json_decode($data[0]->roll_ids);
        if ($roll_id != 1) {
            if (in_array($roll_id, $roll_ids_array)) {
                return $next($request);
            } else {
                return redirect()->route('user.home');
            }
        } else {
            return $next($request);
        }
        die;
    }
}
