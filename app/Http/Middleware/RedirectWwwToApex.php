<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectWwwToApex
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();

        if (str_starts_with(strtolower($host), 'www.')) {
            $apex = substr($host, 4);
            $target = $request->getScheme().'://'.$apex.$request->getRequestUri();

            return redirect()->to($target, 301);
        }

        return $next($request);
    }
}
