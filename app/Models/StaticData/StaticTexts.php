<?php

namespace App\Models\StaticData;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaticTexts extends Model {

    use SoftDeletes;

    protected $table = 'statictexts';
    //что разрешаем править
    protected $fillable = [
        'name', 'alias', 'value',
    ];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

}
