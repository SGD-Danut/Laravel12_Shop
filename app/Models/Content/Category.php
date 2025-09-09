<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\Content\CategoryFactory> */
    use HasFactory;

    // imageUrl() folosită pentru afișarea imaginii categoriei
    public function imageUrl() {
        return '/storage/images/admin/content/categories/' . $this->image;
    }
    // imagePath() folosită pentru ștergerea imaginii categoriei
    public function imagePath() {
        return 'storage/images/admin/content/categories/' . $this->image;
    }
    // defaultImageUrl() folosită pentru afișarea imaginii default a categoriei
    public function defaultImageUrl() {
        return '/admin/img/content/categories/' . $this->image;
    }
    
    public function section() {
        return $this->belongsTo(Section::class, 'section_id');
    }
    // Aceasta este funcția pentru relația One To Many (Polymorphic)
    public function images() {
        return $this->morphMany(Image::class, 'imageable')->orderBy('position');
    }

    // defaultImageUrl() folosită pentru afișarea imaginii default a categoriei
    public function galleryUrl() {
        return '/storage/gallery/images/categories/' . $this->id . '/';
    }
}
