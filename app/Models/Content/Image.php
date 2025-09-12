<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'name',
        'description',
        'position',
        'imageable_id',
        'imageable_type',
    ];

    // Aceasta este funcția pentru relația One To Many (Polymorphic)
    public function imageable() {
        return $this->morphTo();
    }
}
