<?php

namespace App\Http\Livewire\SMComponent\Report;

use Livewire\Component;

class SMSoftwareProgressComponent extends Component
{
    public function render()
    {
        return view('livewire.s-m-component.report.s-m-software-progress-component')
        ->layout('livewire.layouts.sm-base');
    }
}