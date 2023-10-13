<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DeviceDetection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $deviceType = $this->getDeviceType($request);

        if ($deviceType === 'mobile') {
            return redirect($request->root().'/app/'.$request->path());
        }

        return $next($request);
    }

    private function getDeviceType(Request $request)
    {
        $userAgent = $request->userAgent();

        if (preg_match('/(iPhone|iPod|Android|BlackBerry|Opera Mini|IEMobile)/i', $userAgent)) {
            return 'mobile';
        }

        return 'web';
    }
}
