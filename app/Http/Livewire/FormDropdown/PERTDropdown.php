<?php

namespace App\Http\Livewire\FormDropdown;

use App\Models\Base\UserStoryType;
use Livewire\Component;

class PERTDropdown extends Component
{
    public $act_type;
    public $ET=null, $NT=null, $LT=null, $at_id=0, $id_edit=0;
    public function render()
    {
        return view('livewire.form-dropdown.p-e-r-t-dropdown', [
            'act_type'=>UserStoryType::all()
        ]);
    }
}
