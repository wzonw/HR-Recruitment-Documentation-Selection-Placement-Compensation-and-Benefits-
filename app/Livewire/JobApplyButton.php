<?php

namespace App\Livewire;

use Livewire\Component;

class JobApplyButton extends Component
{
    public $job;
    
    public function render()
    {
        return view('livewire.job-apply-button');
    }

    public function toggleApp()
    {
        $this->dispatch(
            'alert',
            type: 'success',
            title: 'Apply Success.',
            text: "Your Application has been successfully submitted!",
            position: 'center',
            timer: 1500,
        );
    }
}
