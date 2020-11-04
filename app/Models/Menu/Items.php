<?php

namespace App\Models\Menu;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Menu\Items
 *
 * @property int $id
 * @property int $menu_id
 * @property string $title
 * @property string $url
 * @property string $target
 * @property int $_lft
 * @property int $_rgt
 * @property string $module
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\Menu\Items[] $children
 * @property-read \App\Models\Menu\Table $menu
 * @property-read \App\Models\Menu\Items|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Items d()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Items newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Items newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Menu\Items onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Items query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Items whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Items whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Items whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Items whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Items whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Items whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Items whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Items whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Items whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Items whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Items whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu\Items whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Menu\Items withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Menu\Items withoutTrashed()
 * @mixin \Eloquent
 */
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
