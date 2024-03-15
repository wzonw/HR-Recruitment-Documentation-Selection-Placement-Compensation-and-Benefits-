<?php

namespace App\Livewire;

use Livewire\Component;

class FileCabinet extends Component
{
    public $applicant;
    public function render()
    {
        return view('livewire.file-cabinet');
    }
}
