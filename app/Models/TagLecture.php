<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagLecture extends Model
{
    use HasFactory;
    protected $table = "tag_lectures";
    public function lectures() {
        return $this->belongsTo('App\Models\Lecture','lecture_ID',"ID");
    }
}
