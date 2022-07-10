<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


    public function handle(Request $request, Closure $next, ...$role)
    {
        $role2id = [
            'admin' => 1,
            'manajer' => 2,
            'perawat' => 3,
            'assisten' => 4,
            'fisioterapi' => 5,
            'farmasi' => 6,
        ];

        $id2role = [
            'admin',
            'manajer',
            'perawat',
            'assisten',
            'fisioterapi',
            'farmasi',
        ];

        $permission = [];

        foreach ($role as $r) {
            $permission[] = $role2id[$r];
        }

        if (session()->get('auth_wlha.username.0')) {
            if (in_array(session()->get('auth_wlha.id_level.0'), $permission)) {
                return $next($request);
            } else {
                return redirect(url()->previous())->with('message', 'Anda login sebagai <b>' . ucwords($id2role[session()->get('auth_wlha.id_level.0') - 1]) . '</b>, anda tidak memiliki akses ke halaman tersebut');
            }
        } else {
            return redirect('/');
        }
    }
}
