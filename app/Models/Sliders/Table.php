<?php

namespace App\Models\Sliders;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Sliders\Images;

class Table extends Model {

    use SoftDeletes;
    const TYPE = 'sliders';
    const MODULE = 'sliders';
    protected $table = 'sliders';
    protected $fillable = ['title', 'alias'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function images() {
        return $this->hasMany('\App\Models\Sliders\Images', 'slider_id', 'id');
    }

    public function getByAlias($alias) {
        $data = static::where('alias', $alias)->first();

        if (!$data) {
            return [];
        }

        $id = $data['id'];

        $data = static::where('id', $id)
                        ->with(['images' => function($query) use($id) {
                                $query->with(['sliders_fields_values' => function($query) use($id) {
                                        $query->with(['sliders_fields' => function($query) use($id) {
                                                $query->where('slider_id', $id)->get();
                                            }])->where('slider_id', $id)->get();
                                    }])->orderBy('order','asc')->where('lang', loc())->where('published',1);
                                    }])->first()->toArray();

                        if (isset($data['images'])) {
                            foreach ($data['images'] as &$v) {
                                if (!count($v['sliders_fields_values'])) {
                                    continue;
                                }
                                $this->_imagesValues($v);
                            }

                            unset($v);
                        }

                        return $data;
                    }

                    private function _imagesValues(&$data) {
                        foreach ($data['sliders_fields_values'] as $values) {
                            $data['properties'][$values['sliders_fields']['alias']] = [
                                'id' => $values['id'],
                                'alias' => $values['sliders_fields']['alias'],
                                'value' => $values['value']
                            ];
                        }
                        unset($data['sliders_fields_values']);
                    }

                }
                