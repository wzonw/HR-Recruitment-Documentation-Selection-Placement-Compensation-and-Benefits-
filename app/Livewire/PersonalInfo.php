<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class PersonalInfo extends Component
{
    public $showingModal = false;

    public $userInfo;
    public $confirmingUserInfoAdd;

    protected $rules = [
        'userInfo.surname' => 'required|string|min:4'
    ];

    public $listeners = [
        'hideMe' => 'hideModal'
    ];

    public function render()
    {
        return view('livewire.personal-info');
    }

    public function showModal(){
        $this->showingModal = true;
    }

    public function hideModal(){
        $this->showingModal = false;
    }

    public function confirmUserInfoAdd(){
        $this->confirmingUserInfoAdd = true;
    }
    
    public function saveUserInfo(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'surname' => ['required', 'string', 'min:3', 'max:255'],

        ])->validateWithBag('PersonalInfo');


        $user->forceFill([
            'name' => $input['name'],
            'middle_name' => $input['middle_name'],
            'surname' => $input['surname'],
        ])->save();

        $this->dispatch(
            'alert',
            type: 'success',
            title: 'Saved.',
            text: "",
            position: 'center',
            timer: 1500,
        );
    }


}
