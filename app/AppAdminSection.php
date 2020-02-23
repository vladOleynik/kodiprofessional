<?php

namespace App;

use SleepingOwl\Admin\Section as SleepingOwlSection;

class AppAdminSection extends SleepingOwlSection {

    public $page = null;
  protected static $_fieldTypes = [
        'text' => 'text', 'textarea' => 'textarea', 'checkbox' => 'checkbox', 'select' => 'select', 'multiselect' => 'multiselect', 'wysiwyg' => 'wysiwyg', 'radio' => 'radio', 'image' => 'image',
        'hidden' => 'hidden', 'images' => 'images', 'file' => 'file'
    ];
    public function activate() {

        if (!is_null($this->page)) {
            $page = \AdminNavigation::getPages()->findById($this->page);
            $page->setActive(true);
        }
    }
     public function isDeletable(\Illuminate\Database\Eloquent\Model $model) {
        return true;
    }
 
    
}
