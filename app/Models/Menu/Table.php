<?php

namespace App\Models\Menu;

use App\Models\Model;

/**
 * Description of Table
 *
 * @author php-jun
 * @property int $id
 * @property string $title
 * @property string $alias
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\Menu\Items[] $items
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Table newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Table newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Table query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Table whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Table whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Table whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Table whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Table whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Table whereUpdatedAt($value)
 * @mixin \Eloquent
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
