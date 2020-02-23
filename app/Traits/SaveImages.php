<?php

namespace App\Traits;

trait SaveImages {
    /**
     * 
     * @param type $model
     * @param type $type
     * @param type $module
     */
    public function put($model, $type = null, $module = null) {
        if (null === $type) {
            $type = $model::TYPE;
        }
        if (null === $module) {
            $module = $model::MODULE;
        }
        $this->type = $type;
        $this->module = $module;
    }

}
