<?php

namespace App\Models\StaticData;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Model;
use App\Helpers\AdminUrl;

class StaticPages extends Model
{
    use SoftDeletes;
    const TYPE = 'static_pages';
    const MODULE = 'static';

    protected $table = 'staticpages';
    protected $casts = ['data' => 'object'];
    protected $guarded = ['id'];

    public function meta()
    {

        return $this->hasOne(\App\Models\Meta::class, 'data_id')->where('type', self::TYPE);
    }

}
