<?php

namespace App\MyPackages\Livewire\Filters;

use Closure;

class SortFilterPipeline implements PipelineInterface
{
    public function __construct(
        private readonly string $sortByColumn,
        private readonly string $sortType = 'desc'
    )
    {
    }

    /**
     * @param $query
     * @param Closure $next
     * @return mixed
     */
    public function handle($query, Closure $next): mixed
    {
        if (!empty($this->sortByColumn)) {
            return $next($query)->orderBy($this->sortByColumn, $this->sortType);
        }

        return $next($query);
    }
}
