<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Content\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use RealRashid\SweetAlert\Facades\Alert;

class UploadImages extends Component
{
    use WithFileUploads;

    #[Validate(['images.*' => 'image|max:1024'])]
    public $images = [];

    public $model;

    public $path;

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

    public function render()
    {
        return view('livewire.admin.upload-images');
    }
}
