<?php

namespace App\MyPackages\Livewire\Filters;

use Closure;

interface PipelineInterface
{
    /**
     * @param $query
     * @param Closure $next
     * @return mixed
     */
    public function handle($query, Closure $next): mixed;

}
