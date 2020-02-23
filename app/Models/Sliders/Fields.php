<?php

namespace App\Models\Sliders;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fields extends Model {
    
    use SoftDeletes;

    protected $table = 'slidersfields';
    protected $fillable = ['alias', 'slider_id', 'title', 'class', 'lang', 'domain'];
    public $timestamps = false;

}
