<?php

namespace App\Http\Pipes;

use Closure;

interface Pipe
{
    public function handle($content, Closure $next);
}
