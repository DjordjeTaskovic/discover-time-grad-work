<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricalArtifact extends Model
{
    use HasFactory;
    public function his_data() {
        return $this->belongsTo('App\Models\HistoricalData','his_data_ID',"ID");
    }
}
