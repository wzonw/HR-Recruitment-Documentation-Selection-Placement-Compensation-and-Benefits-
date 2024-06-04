<?php

namespace App\Livewire;

use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserProfileCover extends Component
{
    public $applicant;
    public function render()
    {
        return view('livewire.user-profile-cover');
    }
}
