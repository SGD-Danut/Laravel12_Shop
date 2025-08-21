<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class SectionStatus extends Component
{
    public $section;

    public function mount($section) {
        $this->section = $section;
    }

    public function changeStatus($property) {
        $this->section->$property = !$this->section->$property;
        $this->section->save();
    }

    public function render()
    {
        return view('livewire.admin.section-status');
    }
}
