<?php

namespace App\Livewire;
use App\Models\JobsAvailable;
use Livewire\Component;
use Livewire\WithPagination;

class JobsTable extends Component
{
    use WithPagination;

    public function toggleApply()
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

    public function render()
    {
       $jobs=JobsAvailable::where('active', 'Y')->paginate(5);
        return view('livewire.jobs-table', [
            'jobs'=> $jobs
        ]);
    }   
}
