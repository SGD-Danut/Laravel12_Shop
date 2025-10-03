<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Content\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use RealRashid\SweetAlert\Facades\Alert;
use Livewire\Attributes\On;

class UploadAndEditImages extends Component
{
    use WithFileUploads;

    // Câmpuri pentru încărcare:
    #[Validate(['images.*' => 'image|max:1024'])]
    public $images = [];

    public $model;

    public $path;

    public $uploadImagesFor;

    // Câmpuri pentru editare:
    public $newImages = [];
    public $descriptions = [];
    public $titles = [];

    // Metode pentru încărcare:
    public function formatFileSize($bytes) {
        // Convertim dimensiunea fișierului din bytes în kilobytes (1 KB = 1024 bytes)
        $kb = $bytes / 1024;

        // Dacă fișierul are mai puțin de 1024 KB (adică < 1 MB),
        // returnăm dimensiunea exprimată în kilobytes.
        if ($kb < 1024) {
            // number_format($kb, 2) -> formatează numărul cu 2 zecimale, ex: 512.35
            return number_format($kb, 2) . ' KB';
        }

        // Dacă fișierul are cel puțin 1024 KB (adică >= 1 MB),
        // împărțim din nou la 1024 ca să obținem valoarea în megabytes (1 MB = 1024 KB)
        return number_format($kb / 1024, 2) . ' MB';
    }

    public function getFileSizeClass($bytes)
    {
        $kb = $bytes / 1024;

        return $kb >= 1024 ? 'danger' : 'muted';
    }

    public function save() {
        $this->validate();
        
        // Pentru fiecare imagine facem următoarele:
        foreach ($this->images as $key => $image) {
            // Setăm numele imaginii:
            $imageName = Str::random(4) . '_' . $image->getClientOriginalName();

            // Stocăm imaginea pe disk-ul images:
            $image->storeAs($this->path . '/' . $this->model->id, $imageName, 'images');

            // Inserăm imaginea în baza de date:
            $image = new Image();
            $image->name = $imageName;
            $image->position = ($key + 1) * 10;

            $this->model->images()->save($image);
        }

        $numberOfImages = count($this->images);
        $successMessage = $numberOfImages . " imagini au fost încărcate cu succes!";
        $this->dispatch('upload-images-message', $successMessage);

        session()->flash('success', 'Imaginile au fost încărcate cu succes!');
        
        $this->images = null;

        return redirect()->back();
    }

    protected function cleanupOldUploads()
    {
        $storage = Storage::disk('local');

        foreach ($storage->allFiles('livewire-tmp') as $filePathname) {
            // On busy websites, this cleanup code can run in multiple threads causing part of the output
            // of allFiles() to have already been deleted by another thread.
            if (! $storage->exists($filePathname)) continue;

            $yesterdaysStamp = now()->subSeconds(3)->timestamp;
            if ($yesterdaysStamp > $storage->lastModified($filePathname)) {
                $storage->delete($filePathname);
            }
        }
    }

    // Metode pentru editare, ștergere:
    public function updatedNewImages($value, $key) {
        // $key = ID-ul imaginii (din wire:model="newImages.{id}")
        // $value = fișierul uploadat pentru acea imagine
        
        try {
            $this->validateOnly("newImages.$key", [
                "newImages.$key" => "image|max:1024", // max 1 MB
            ], [], [
                "newImages.$key" => "image"
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Dacă validarea eșuează, eliminăm fișierul invalid
            unset($this->newImages[$key]);

            // Trimitem eroarea mai departe pentru a fi afișată
            throw $e;
        }

        // Căutăm imaginea în baza de date
        $image = Image::findOrFail($key);

        // Ștergem fișierul vechi de pe HDD
        Storage::disk('images')->delete($this->path . '/' . $image->imageable->id . '/' . $image->name);

        // Setăm numele noii imagini
        $newName = Str::random(4) . '_' . $value->getClientOriginalName();

        // Salvăm fișierul nou pe disk
        $value->storeAs($this->path . '/' . $image->imageable->id . '/', $newName, 'images');

        // Actualizăm baza de date
        $image->name = $newName;
        $image->save();

        // Resetăm doar pentru acea imagine
        unset($this->newImages[$key]);
    }

    public function mount() {
        foreach ($this->model->images as $image) {
            $this->descriptions[$image->id] = $image->description;
            $this->titles[$image->id] = $image->title;
        }
    }

    public function updatedDescriptions($value, $key) {
        // $key = id-ul imaginii (ex. 15)
        // $value = noua descriere introdusă
        
        $this->validateOnly("descriptions.$key", [
            "descriptions.$key" => "nullable|string|max:255",
        ], [], [
            "descriptions.$key" => "Descriere imagine",
        ]);

        $image = Image::find($key);
        if ($image) {
            $image->update(['description' => $value]);
        }
    }

    public function updatedTitles($value, $key) {
        // $key = id-ul imaginii
        // $value = noul titlu introdus
        
        $this->validateOnly("titles.$key", [
            "titles.$key" => "required|string|max:255",
        ], [], [
            "titles.$key" => "Titlu imagine",
        ]);

        $image = Image::find($key);
        if ($image) {
            $image->update(['title' => $value]); 
        }
    }

    #[On('permanent-delete-image')] 
    public function permanentDeleteImage($imageId) {
        // Căutăm imaginea care vrem să o ștergem:
        $image = Image::findOrFail($imageId);
        
        // Ștergem imaginea de pe HDD:
        Storage::disk('images')->delete($this->path . '/' . $image->imageable->id . '/' . $image->name);

        // Ștergem imaginea din baza de date:
        $image->delete();
    }

    #[On('permanent-delete-all-images')] 
    public function permanentDeleteAllImages() {
        // Ștergem toate imaginile ce apartin modelului din baza de date:
        $this->model->images()->delete();

        // Ștergem toate imaginile ce apartin modelului de pe HDD:
        Storage::disk('images')->deleteDirectory($this->path . '/' . $this->model->id);
    }

    public function render()
    {
        return view('livewire.admin.upload-and-edit-images');
    }
}
