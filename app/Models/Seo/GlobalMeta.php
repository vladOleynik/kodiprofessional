<?php

namespace App\Models\Seo;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Model;

/**
 * App\Models\Seo\GlobalMeta
 *
 * @property int $id
 * @property string|null $url
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property string|null $seo_text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo\GlobalMeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo\GlobalMeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo\GlobalMeta query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo\GlobalMeta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo\GlobalMeta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo\GlobalMeta whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo\GlobalMeta whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo\GlobalMeta whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo\GlobalMeta whereSeoText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo\GlobalMeta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo\GlobalMeta whereUrl($value)
 * @mixin \Eloquent
 */
class GlobalMeta extends Model {

    protected $table = 'globalmeta';
}
