<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Profile;

class CheckProfile
{

    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()) {
            return redirect('login');
        }

        $this->user = auth()->user();
        //check if user has a profile
        if (!$this->user->profile) {
            //create profile
            Profile::create([
                'user_id' => $this->user->id,
            ]);
        }

        return $next($request);
    }

}
