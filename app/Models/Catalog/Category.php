<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Model;

class Category extends Model
{

    use SoftDeletes,
        \Kalnoy\Nestedset\NodeTrait;

    const TYPE = 'catalog_categories';

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
    protected $casts = ['data' => 'object', 'images' => 'object'];

    public function meta()
    {

        return $this->hasOne(\App\Models\Meta::class, 'data_id')->where('type', self::TYPE);
    }

    public function products()
    {

        return $this->belongsToMany('App\Models\Catalog\Product');
    }


}
