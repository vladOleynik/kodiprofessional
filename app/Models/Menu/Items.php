<?php

namespace App\Models\Menu;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Items extends Model {

    use \Kalnoy\Nestedset\NodeTrait,
        SoftDeletes;

    protected $table = 'menuitems';
    protected $fillable = [
        'title', 'url', 'target', 'class'
    ];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    /**
     * Get the menu that owns the comment.
     */
    public function menu() {
        return $this->belongsTo('App\Models\Menu\Table');
    }

}
