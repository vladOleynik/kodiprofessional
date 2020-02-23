<?php

namespace App\Admin\Sections\Shop;

use SleepingOwl\Admin\Contracts\DisplayInterface;
use SleepingOwl\Admin\Contracts\FormInterface;
use AdminColumn;
use SleepingOwl\Admin\Facades\TableColumnEditable as AdminColumnEditable;
use AdminDisplay;
use AdminDisplayFilter;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Facades\TableColumnFilter as AdminColumnFilter;
use SleepingOwl\Admin\Contracts\Initializable;
use App\AppAdminSection;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Navigation\Page;

class Payment extends AppAdminSection implements Initializable {
    
    
    protected $title = 'Способы оплаты';
    protected $model = \App\Models\Shop\Payment::class;
    protected $alias = 'shop/payments';

    public function initialize() {

    }

    public function onDisplay() {
         $this->activate();
       $page = \AdminNavigation::getPages()->findById('payment');
       $page->setActive(true);
        $display = AdminDisplay::datatables();
        $display->setColumns([
            AdminColumn::text('id', 'ID'),
            AdminColumnEditable::text('title', 'Название'),
            AdminColumnEditable::checkbox('enabled','да','нет')->setLabel('Включен')
                
        ]);
        return $display;
    }

    public function onCreate() {
        return $this->onEdit(null);
    }

    public function onEdit($id) {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('title', 'Название'),
            AdminFormElement::checkbox('enabled', 'Включен'),
            AdminFormElement::image('path','Изображение'),
          
        ]);
    }

    
    public function isDeletable(Model $model) {
        return false;
    }
}
