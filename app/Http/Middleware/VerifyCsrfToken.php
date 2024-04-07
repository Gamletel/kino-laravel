<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * URI, которые следует исключить из проверки CSRF.
     *
     * @var array
     */
    protected $except = [
        '/register',
//        'http://example.com/foo/bar',
//        'http://example.com/foo/*',
    ];
}
