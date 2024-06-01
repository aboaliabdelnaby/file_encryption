<?php

namespace App\MyPackages\Livewire\Components\Traits;

use Livewire\{WithPagination};

trait IndexHelper
{
    use WithPagination;

    public string $search = '';
    public string $sortField = 'created_at';
    public string $sortType = 'desc';
    public int $paginatePerPage = 10;
    public bool $showToast = true;
    protected string $paginationTheme = 'bootstrap';
    /**
     * @param $field
     * @return void
     */
    public function sortByColumn($field): void
    {
        $this->sortType = ($this->sortField === $field) ? $this->reverseSort() : 'asc';
        $this->sortField = $field;
    }

    private function reverseSort(): string
    {
        return $this->sortType === 'asc'
            ? 'desc'
            : 'asc';
    }

    /**
     * @return void
     */
    public function updatingSearch(): void
    {
        $this->showToast = false;
        $this->resetPage();
    }

    /**
     * @return void
     */
    public function updatingPaginate(): void
    {
        $this->showToast = false;
        $this->resetPage();
    }

    /**
     * @param $page
     * @return void
     */
    public function updatingPage($page): void
    {
        if ($this->showToast) {
            $trans = trans('share.Current Page');
            $this->dispatch('page', "$trans ( $page )");
            return;
        }
        $this->showToast = true;
    }


}
