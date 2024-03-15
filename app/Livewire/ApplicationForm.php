<?php

namespace App\Livewire;

use App\Models\Application;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Laravel\Jetstream\Jetstream;

class ApplicationForm extends Component
{
    public function create(array $input)
    {
        $application = New Application;
        $application->name = $input['name'];
        $application->save();

        return redirect()->route('success')->with('message', 'Success');
    }
    public function render()
    {
        return view('livewire.application-form');
    }
}
