<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    public function subject() {
        return $this->hasMany(Subject::class, 'institution_id');
    }

    //protected $table = 'institutions';
}
