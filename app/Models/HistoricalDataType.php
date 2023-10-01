<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricalDataType extends Model
{
    use HasFactory;
    public function his_data() {
        return $this->hasMany('App\Models\HistoricalData','type_ID',"ID");
    }
}
