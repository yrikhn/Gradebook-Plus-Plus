<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    /**
     * @var array|mixed
     */


    /**
     * @var mixed
     */

    public function subject() {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
