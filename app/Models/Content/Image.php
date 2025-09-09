<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    // Aceasta este funcția pentru relația One To Many (Polymorphic)
    public function photoable() {
        return $this->morphTo();
    }
}
