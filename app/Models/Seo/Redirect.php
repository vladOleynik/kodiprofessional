<?php

namespace App\Models\Seo;

use App\Models\Model;

/**
 * App\Models\Seo\Redirect
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo\Redirect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo\Redirect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo\Redirect query()
 * @mixin \Eloquent
 */
class Redirect extends Model {

  protected $table = 'redirects';
    public $timestamps = false;
      protected $guarded = [];
    
}
