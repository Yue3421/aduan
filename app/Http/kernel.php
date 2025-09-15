<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareGroups = [
        'web' => [
            // ... middleware lainnya ...
        ],
        'api' => [
            // ... middleware lainnya ...
        ],
    ];

    protected $routeMiddleware = [
        // ... middleware lainnya ...
        'role' => \App\Http\Middleware\Role::class,
    ];
}