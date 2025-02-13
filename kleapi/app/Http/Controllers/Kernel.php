<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

class Kernel extends HttpKernel
{
    /**
     *
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [

        ],


     'api' => [
         \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
         'throttle:api',
         \Illuminate\Routing\Middleware\SubstituteBindings::class,
     ],

    ];

}
