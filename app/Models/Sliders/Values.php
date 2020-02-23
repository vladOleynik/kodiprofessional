<?php

namespace App\Models\Sliders;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Values extends Model {

    use SoftDeletes;

    protected $table = 'slidersfieldsvalues';
    protected $fillable = ['field_id', 'slider_id', 'data_id', 'value', 'lang', 'domain'];
    public $timestamps = false;

    public function sliders_fields() {
        return $this->hasOne('App\Models\Sliders\Fields', 'id', 'field_id');
    }

}
