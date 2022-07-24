<?php

namespace App\Http\Livewire\SMComponent\Software;

use Livewire\Component;

class SMCPMComponent extends Component
{
    public function render()
    {
        return view('livewire.s-m-component.software.s-m-c-p-m-component')
        ->layout('livewire.layouts.sm-base');
    }
}
