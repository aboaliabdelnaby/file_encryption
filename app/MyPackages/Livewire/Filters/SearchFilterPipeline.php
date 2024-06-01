<?php

namespace App\MyPackages\Livewire\Filters;

use Closure;

class SearchFilterPipeline implements PipelineInterface
{

    public function __construct(
        private readonly array  $columns,
        private readonly string $search
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
        if (!empty($this->search) && count($this->columns)) {
            return $next($query)->where(function ($query) {
                foreach ($this->columns as $index => $column) {
                    if ($index === 0) {
                        $query->where($column, 'like', '%' . trim($this->search) . '%');
                    } else {
                        $query->orWhere($column, 'like', '%' . trim($this->search) . '%');
                    }
                }
            });
        }
        return $next($query);
    }
}
