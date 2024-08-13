<?php

namespace App\Livewire;

use Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Dotenv\Exception\ValidationException;

class ImageUpload extends Component
{
    use WithFileUploads;

    public $images=[];
    public $previews=[];

    protected $rules=[
       'images.*'=>'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:1024',
    ];
    protected $messages = [
        'images.*.image' => 'Each file must be an image.',
        'images.*.mimes' => 'Only JPEG, PNG, JPG, WEBP, SVG and GIF formats are allowed.',
        'images.*.max' => 'Each image must not exceed 1MB in size.',
    ];


    public function updatedImages(){
        $this->validate();
        if(count($this->images)>4){
            $this->reset('images');
            $this->reset('previews');
             $this->dispatch('notification',['error'=>'You can only upload a maximum of 4 images.']);
            return;
        }

        $this->previews=[];

        foreach($this->images as $image)
        {
            $this->previews[]=$image->temporaryUrl();
        }
    }

    public function render()
    {
        return view('livewire.image-upload');
    }
}
