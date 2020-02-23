<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FundamentalSetting extends Model
{
    protected $table = 'fundamentalsettings';
    protected $fillable = [
        'name', 'var', 'value', 'description',
    ];
}
