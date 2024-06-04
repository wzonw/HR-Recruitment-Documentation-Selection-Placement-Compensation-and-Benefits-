<?php

namespace App\Livewire;

use Livewire\Component;

class FileCabinet extends Component
{
    public $applicant, $f;
    public function render()
    {
        return view('livewire.file-cabinet');
    }
}
