<?php

namespace App\Livewire;

use Livewire\Component;

class InfoButtons extends Component
{
    public $userInfo;
    public $confirmingUserInfoAdd;

    protected $rules = [
        'userInfo.surname' => 'required|string|min:4'
    ];

    public function render()
    {
        return view('livewire.info-buttons');
    }

    public function confirmUserInfoAdd(){
        $this->confirmingUserInfoAdd = true;
    }

    public function saveUserInfo(){
        $this->validate();
    }
}
