<?php

namespace App\Http\Livewire\SMComponent\Base;

use Livewire\Component;
use Livewire\WithPagination;

class SMCompanyComponent extends Component
{

    public function render()
    {

        return view('livewire.s-m-component.base.s-m-company-component')
        ->layout('livewire.layouts.sm-base');
    }
}
