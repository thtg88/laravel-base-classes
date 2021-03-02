<?php

namespace Thtg88\LaravelBaseClasses\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Thtg88\LaravelBaseClasses\BasicAuthShield;

class BasicAuthMiddleware
{
    /**
     * The shield instance.
     *
     * @var \Thtg88\LaravelBaseClasses\BasicAuthShield
     */
    protected BasicAuthShield $shield;

    /**
     * Create a new middleware class.
     *
     * @param \Thtg88\LaravelBaseClasses\BasicAuthShield $shield
     *
     * @return void
     */
    public function __construct(BasicAuthShield $shield)
    {
        $this->shield = $shield;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $user
     *
     * @return mixed
     */
    public function handle($request, Closure $next, ?string $user = null)
    {
        // Don't shield if disabled
        if (config('shield.mode') === false) {
            return $next($request);
        }

        $verified = $this->shield->verify(
            $request->getUser(),
            $request->getPassword(),
            $user
        );
        if ($verified === false) {
            throw new UnauthorizedHttpException('Basic');
        }

        return $next($request);
    }
}
