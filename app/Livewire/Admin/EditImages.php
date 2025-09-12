<?php

namespace App\Livewire\Admin;

use App\Models\Content\Image;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;

class EditImages extends Component
{
    use WithFileUploads;

    // Proprietățile primite din componenta părinte: UploadImages.php / upload-images.blade.php
    public $theOldImageForEditing;
    public $path;

    // Proprietățile care fac legătura cu input-urile din fișierul de tip view: edit-images.blade.php:
    public $position;
    public $name;
    public $description;
    public $currentUrl;

    #[Validate(['theNewImageForUpload' => 'image|max:1024'])]
    public $theNewImageForUpload;
    

    public function mount() 
    {
        $this->position = $this->theOldImageForEditing->position;
        $this->name = $this->theOldImageForEditing->name;
        $this->description = $this->theOldImageForEditing->description;
        $this->currentUrl = url()->current();
    }

    public function updatedPosition($value) {
        $this->theOldImageForEditing->position = $value;
        $this->theOldImageForEditing->save();
        // return redirect(request()->header('Referer'));
        return redirect()->to($this->currentUrl);
    }

    public function updatedName($value) {
        $this->theOldImageForEditing->name = $value;
        $this->theOldImageForEditing->save();
    }

    public function updatedDescription($value) {
        $this->theOldImageForEditing->description = $value;
        $this->theOldImageForEditing->save();
    }

    public function updatedTheNewImageForUpload($value) {
        $this->validate();

        // Ștergem vechea imagine de pe HDD:
        Storage::disk('images')->delete($this->path . $this->theOldImageForEditing->name);

        // Setăm numele noii imagini:
        $theNewImageForUploadName = Str::random(4) . '_' . $value->getClientOriginalName();

        // Salvăm noua imagine pe HDD:
        $value->storeAs($this->path, $theNewImageForUploadName, 'images');

        // Salvăm informațiile despre iamgine în baza de date:
        $this->theOldImageForEditing->name = $theNewImageForUploadName;
        $this->theOldImageForEditing->save();

        // Deselectăm imaginea:
        $this->theNewImageForUpload = null;
    }

    public function render()
    {
        return view('livewire.admin.edit-images');
    }
}
