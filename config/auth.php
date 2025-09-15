<?php

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'masyarakat',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'masyarakat',
        ],
        'petugas' => [
            'driver' => 'session',
            'provider' => 'petugas',
        ],
    ],

    'providers' => [
        'masyarakat' => [
            'driver' => 'eloquent',
            'model' => App\Models\Masyarakat::class,
        ],
        'petugas' => [
            'driver' => 'eloquent',
            'model' => App\Models\Petugas::class,
        ],
    ],

    'passwords' => [
        'masyarakat' => [
            'provider' => 'masyarakat',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'petugas' => [
            'provider' => 'petugas',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],
];