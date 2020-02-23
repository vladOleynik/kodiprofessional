<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\Sliders;

use App\Models\Model;

/**
 * Description of Images
 *
 * @author php-jun
 */
class Images extends Model {

    protected $table = 'slidersimages';
    protected $fillable = ['path', 'data'];
    public $timestamps = false;

    public function sliders_fields_values() {
        return $this->hasMany('\App\Models\Sliders\Values', 'data_id', 'id');
    }

    public function getPreviewAttribute() {
        $data = static::where('id', $this->id)->first();

        if (empty($data['path'])) {
            return '';
        }

        $path = explode(',', $data['path'])[0];

        return $path;
    }

}
