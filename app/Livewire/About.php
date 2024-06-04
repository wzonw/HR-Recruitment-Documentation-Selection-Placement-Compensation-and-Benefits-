<?php

namespace App\Livewire;

use Livewire\Component;

class About extends Component
{
    public $user, $job, $leaves;
    public function render()
    {
        return view('hr.about');
    }
}
