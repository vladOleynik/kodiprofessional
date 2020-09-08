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
 * @property int $id
 * @property int $slider_id
 * @property string $path
 * @property string|null $alt
 * @property string|null $title
 * @property string|null $content
 * @property int|null $parent_id
 * @property int|null $order
 * @property int|null $published
 * @property string|null $deleted_at
 * @property-read mixed $preview
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sliders\Values[] $sliders_fields_values
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Images newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Images newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Images query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Images whereAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Images whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Images whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Images whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Images whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Images whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Images wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Images wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Images whereSliderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Images whereTitle($value)
 * @mixin \Eloquent
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
