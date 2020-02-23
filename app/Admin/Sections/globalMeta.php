<?php

namespace App\Admin\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Initializable;
use App\AppAdminSection;
use SleepingOwl\Admin\Navigation\Page;


class GlobalMeta extends AppAdminSection implements Initializable {

    protected $checkAccess = false;
    protected $title = 'Global Meta';
    protected $alias = 'globalMeta';

    public function initialize() {

        $this->addToNavigation(13)->setId('globalMeta');
    }

    public function onDisplay() {
            $table = AdminDisplay::table();
            $table->setColumns([
            AdminColumn::text('id','ID'),
            AdminColumn::text('url','URL Address'),
            AdminColumn::text('meta_title','Meta Title'),
            AdminColumn::text('meta_description','Meta Description'),
            AdminColumn::text('meta_keywords','Meta Keywords'),

        ]);
        return $table;
    }

    public function onCreate() {
          
        return $this->onEdit(null);
    }

    public function onEdit($id) {
      return AdminForm::panel()->addBody([

          AdminFormElement::text('url','URL Address'),
          AdminFormElement::text('meta_title','Meta Title'),
          AdminFormElement::text('meta_description','Meta Description'),
          AdminFormElement::text('meta_keywords','Meta Keywords'),
           ]);
    }
    public function getIcon()
    {
        return 'fa fa-newspaper-o';
    }

}
