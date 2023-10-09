<?php

namespace App\Traits;
use Livewire\WithPagination;
use Livewire\Component as LivewireComponent;

/**
 *
 * trait untuk attribute pagiate pada livewire
 *
 */
trait PaginateLivewire
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $limitPage = 10;
    public $search = '';
    public $page = 1;

    public function queryString()
    {
        $queryString = LivewireComponent::queryString();

        return array_merge($queryString, ['search' => ['except' => '']]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
