<?php
/**
 * Created by PhpStorm.
 * User: dyako
 * Date: 19.02.2019
 * Time: 16:53
 */

namespace App\Models;


/**
 * App\Models\FormMessage
 *
 * @property int $id
 * @property string $email
 * @property string $msg
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormMessage whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormMessage whereMsg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FormMessage extends Model
{


    protected $fillable = ['email', 'msg'];

}
