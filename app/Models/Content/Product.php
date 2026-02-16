<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Includem clasa SoftDeletes

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\Content\ProductFactory> */
    use HasFactory, SoftDeletes; // Specificăm că folosim SoftDeletes

    // Aceasta este funcția pentru relația One To Many
    // Un produs aparține unei secțiuni
    public function section() {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    // Aceasta este funcția pentru relația One To Many
    // Un produs aparține unui brand
    public function brand() {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    // Aceasta este funcția pentru relația One To Many (Polymorphic)
    // Un produs are mai multe imagini
    public function images() {
        return $this->morphMany(Image::class, 'imageable')->orderBy('position');
    }

    // Aceasta este funcția pentru relația ManyTo Many
    // Un produs aparține mai multor categorii / Un produs are mai multe categorii
    public function categories() {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    // galleryUrl() folosită pentru afișarea galeriei de imagini a produsului
    public function galleryUrl() {
        return '/storage/gallery/images/products/' . $this->id . '/';
    }

    // imageUrl() folosită pentru afișarea imaginii produsului
    public function imageUrl() {
        return '/storage/images/admin/content/products/' . $this->image;
    }

    /* getImageUrlAttribute() folosită tot pentru afișarea imaginii produsului la fel ca imageUrl() de mai sus
        chiar dacă funcția se numește getImageUrlAttribute() noi trebuie să nu apelăm funcția din obiect
        ci apelăm doar un câmp numindu-se 'imageUrl' 
    */
    public function getImageUrlAttribute() {
        return '/storage/images/admin/content/products/' . $this->image;
    }

    // imagePath() folosită pentru ștergerea imaginii produsului
    public function imagePath() {
        return 'storage/images/admin/content/products/' . $this->image;
    }

    // defaultImageUrl() folosită pentru afișarea imaginii default a produsului
    public function defaultImageUrl() {
        return '/admin/img/content/products/' . $this->image;
    }

    /* getDefaultImageUrlAttribute() folosită tot pentru afișarea imaginii default a produsului la fel ca defaultImageUrl() de mai sus
        chiar dacă funcția se numește getDefaultImageUrlAttribute() noi trebuie să nu apelăm funcția din obiect
        ci apelăm doar un câmp numindu-se 'defaultImageUrl' 
    */
    public function getDefaultImageUrlAttribute() {
        return '/admin/img/content/products/' . $this->image;
    }
}
