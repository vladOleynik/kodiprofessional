<?php

namespace App\Traits;

use Illuminate\Support\Facades\Input;
use App\Models\Meta;

trait Sluggable {

    protected $customSlugField = 'customize_alia';

    public function slug(&$model, $field = 'title') {
     
        
        $customSlug = Input::get($this->customSlugField);
        
        if (mb_strlen($customSlug)) {
            $slug = str_slug($customSlug);
        } else {
        
            $field = $model->{$field};
        
            $slug = str_slug($field);
        }
        
        $originalSlug = $model->meta->alias;
 
        if(!empty($originalSlug)) {
               
              $slugExists = Meta::where('alias', '=', $originalSlug);
    
               if (!$slugExists->exists()) {
            
                return $originalSlug;
               
            } elseif($model->id != $slugExists->first()->data_id) {
           
                $slug = $slug . '-' . time();
                $model->meta->alias = $slug;
                return $slug;
        } else {
            
           return $originalSlug;
        }}
      
      
        if ($originalSlug !== $slug) {
           
            $slugExists = Meta::where('alias', '=', $slug);
          
            if (!$slugExists->exists()) {
                $model->meta->alias = $slug;
                return $slug;
            } else {
                $slug = $slug . '-' . time();
                $model->meta->alias = $slug;
                return $slug;
                //return $slug
            }
        } else {
            return $originalSlug;
        }
    }
    
    
    

}
