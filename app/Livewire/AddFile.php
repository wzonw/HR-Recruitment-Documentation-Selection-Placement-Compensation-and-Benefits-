<?php

namespace App\Livewire;

use Livewire\Component;

class AddFile extends Component
{
    public $file;
    public function render()
    {
        return view('livewire.add-file');
    }
}
