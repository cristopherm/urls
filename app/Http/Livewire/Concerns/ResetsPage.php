<?php

namespace App\Http\Livewire\Concerns;

trait ResetsPage
{
    /**
     * Resets the page.
     */
    public function onResetPage()
    {
        $this->resetPage();
    }
}
