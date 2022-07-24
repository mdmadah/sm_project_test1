<?php

namespace App\Http\Livewire\OwnerComponent;

use Livewire\Component;

class OwnerIndex extends Component
{
    public function render()
    {
        return view('livewire.owner-component.owner-index')
        ->layout('livewire.layouts.owner-base');
    }
}
