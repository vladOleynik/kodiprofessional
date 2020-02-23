<?php

namespace App\Models\Menu;

use App\Models\Model;

/**
 * Description of Table
 *
 * @author php-jun
 */
class Table extends Model {

    protected $table = 'menus';
    protected $fillable = ['name'];

    /**
     * Get the comments for the blog post.
     */
    public function items() {
        return $this->hasMany('App\Models\Menu\Items', 'menu_id');
    }

}
