<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    protected $guarded = [];
    // photoUrl() folosită pentru afișarea imaginii membrului staff
    public function photoUrl() {
        return '/storage/images/admin/staff/' . $this->photo;
    }
    // photoPath() folosită pentru ștergerea imaginii membrului staff
    public function photoPath() {
        return 'storage/images/admin/staff/' . $this->photo;
    }
}
