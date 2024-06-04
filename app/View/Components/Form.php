<?php

namespace App\View\Components;

use App\Models\Application;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Form extends Component
{
    use WithFileUploads;

    public $file;

    public $original_filename = "";
    public $filepath = "";
    public $success = 0;
    public $isImage = false;

    public function create()
    {
        $this->success = 0;
        $this->isImage = false;

        $this->validate([
            'file' => 'required|mimes:png,pdf|max:2048'
        ]);

        $this->original_filename = $this->file->getClientOriginalName();

        $filename = $this->file->store('files', 'public');

        Application::create([
            'file' => $filename,
            'job_id' => 1,
            'name' => 'test',
            'email' => 'test@gmail.com',
            'contact_number' => '09999999999',
        ]);

        $extension = strtolower($this->file->extension());
        $image_exts = array('png');
        if(in_array($extension, $image_exts)){
            $this->isImage = true;
        }
        
        $this->success = 1;
        $this->filepath = Storage::url($filename);

    }

    public function render()
    {
        return view('form');
    }
}
