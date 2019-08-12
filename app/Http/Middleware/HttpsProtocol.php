<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class HttpsProtocol
{

    public function handle($request, Closure $next)
    {

        return redirect()->secure($request->getRequestUri());
    }
}
