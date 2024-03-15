<?php

namespace App\Livewire;

use Livewire\Component;

class EmpProfile extends Component
{
    public $user, $job;
    public function render()
    {
        return view('hr.emp-profile');
    }
}
