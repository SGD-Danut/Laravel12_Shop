<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /** @use HasFactory<\Database\Factories\Content\SectionFactory> */
    use HasFactory;

    // imageUrl() folosită pentru afișarea imaginii secțiunii
    public function imageUrl() {
        return '/storage/images/admin/content/sections/' . $this->image;
    }
    // imagePath() folosită pentru ștergerea imaginii secțiunii
    public function imagePath() {
        return 'storage/images/admin/content/sections/' . $this->image;
    }
}
