<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /** @use HasFactory<\Database\Factories\Content\BrandFactory> */
    use HasFactory;

    // imageUrl() folosită pentru afișarea imaginii brand-ului
    public function imageUrl() {
        return '/storage/images/admin/content/brands/' . $this->image;
    }

    /* getImageUrlAttribute() folosită tot pentru afișarea imaginii brand-ului la fel ca imageUrl() de mai sus
        chiar dacă funcția se numește getImageUrlAttribute() noi trebuie să nu apelăm funcția din obiect
        ci apelăm doar un câmp numindu-se 'imageUrl' 
    */
    public function getImageUrlAttribute() {
        return '/storage/images/admin/content/brands/' . $this->image;
    }

    // imagePath() folosită pentru ștergerea imaginii brand-ului
    public function imagePath() {
        return 'storage/images/admin/content/brands/' . $this->image;
    }

    // defaultImageUrl() folosită pentru afișarea imaginii default a brand-ului
    public function defaultImageUrl() {
        return '/admin/img/content/brands/' . $this->image;
    }

    /* getDefaultImageUrlAttribute() folosită tot pentru afișarea imaginii default a brand-ului la fel ca defaultImageUrl() de mai sus
        chiar dacă funcția se numește getDefaultImageUrlAttribute() noi trebuie să nu apelăm funcția din obiect
        ci apelăm doar un câmp numindu-se 'defaultImageUrl' 
    */
    public function getDefaultImageUrlAttribute() {
        return '/admin/img/content/brands/' . $this->image;
    }

    // Aceasta este funcția pentru relația One To Many (Polymorphic)
    public function images() {
        return $this->morphMany(Image::class, 'imageable')->orderBy('position');
    }

    // galleryUrl() folosită pentru afișarea galeriei de imagini a brand-ului
    public function galleryUrl() {
        return '/storage/gallery/images/brands/' . $this->id . '/';
    }

    // Aceasta este funcția pentru relația One To Many
    // Un brand are mai multe produse
    public function products() {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }
}
