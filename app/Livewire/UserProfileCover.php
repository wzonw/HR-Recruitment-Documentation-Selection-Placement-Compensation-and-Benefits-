<?php

namespace App\Livewire;

use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserProfileCover extends Component
{
    public function render()
    {
        $applicant = Application::where('id', Auth::user()->application_id)->first();
        return view('livewire.user-profile-cover', compact('applicant'));
    }
}
