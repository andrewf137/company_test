<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Exceptions\InvalidTokenException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $authorization = $request->header('Authorization');

            if (!$authorization) {
                throw new InvalidTokenException('The token could not be parsed from the request');
            }

            [$bearer, $token] = explode(' ', $authorization, 2);

            if ('Bearer' !== $bearer || !$token) {
                throw new InvalidTokenException('The token could not be parsed from the request');
            }

            if ($token !== env('SECRET_TOKEN')) {
                throw new InvalidTokenException('Invalid token');
            }

            return $next($request);
        } catch (\Exception $e) {
            return response()->json([
                'error' => \sprintf('Error while decoding token: %s', $e->getMessage())
            ], 401);
        }
    }
}
