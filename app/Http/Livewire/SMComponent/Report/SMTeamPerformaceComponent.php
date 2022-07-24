<?php

namespace App\Http\Livewire\SMComponent\Report;

use Livewire\Component;

class SMTeamPerformaceComponent extends Component
{
    public function render()
    {
        return view('livewire.s-m-component.report.s-m-team-performace-component')
        ->layout('livewire.layouts.sm-base');
    }
}