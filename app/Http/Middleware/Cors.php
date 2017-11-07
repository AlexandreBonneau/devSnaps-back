<?php namespace App\Http\Middleware;

use Closure;

/**
 * Middleware CORS that tells the server to accept requests from specific domains.
 */
class Cors {
    /**
     * Handle the CORS on requests.
     * cf. https://www.youtube.com/watch?v=JEn16aQoowE&list=PLkZU2rKh1mT9TgMvpFY1QVrX2z4I3D3Jq
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $domains = [
            //TODO Use the .env file to determine the accepted domains
            'http://devsnaps:3000',
            'http://localhost:3000',
        ];

        if (isset($request->server()['HTTP_ORIGIN'])) {
            $origin = $request->server()['HTTP_ORIGIN'];
            if (in_array($origin, $domains)) {
                // Only define a single domain here
                header('Access-Control-Allow-Origin: '.$origin);
                // OPTIONS here is needed for CORS requests
                header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS, PATCH');
                header('Access-Control-Allow-Headers: Origin, Content-type, Authorization');
            }
        }

        return $next($request);
    }
}
