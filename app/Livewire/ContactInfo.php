<?php

namespace App\Livewire;

use Livewire\Component;

class ContactInfo extends Component
{
    public $showingModal = false;

    public $listeners = [
        'hideMe' => 'hideModal'
    ];

    public function render()
    {
        return view('livewire.contact-info');
    }

    public function showModal(){
        $this->showingModal = true;
    }

    public function hideModal(){
        $this->showingModal = false;
    }

}
