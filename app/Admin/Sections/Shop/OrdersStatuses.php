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

class OrdersStatuses extends AppAdminSection implements Initializable {

    protected $title = 'Статусы заказов';
    protected $model = \App\Models\Shop\OrderStatus::class;
    protected $alias = 'shop/orders_statuses';

    public function initialize() {
        $this->updating(function($config, $model) {
            if ($model->is_default) {
                \DB::table($model->getTable())->update(['is_default' => 0]);
            }
        });
        $this->creating(function($config, $model) {
            if ($model->is_default) {
                \DB::table($model->getTable())->update(['is_default' => 0]);
            }
        });
    }

    public function onDisplay() {
         $this->activate();
       $page = \AdminNavigation::getPages()->findById('status');
       $page->setActive(true);
        \Meta::addJs('admin-shop-orders-statuses', resources_url('js/shop/order-statuses.js'), ['admin-default']);
        $display = AdminDisplay::datatables();
        $display->setColumns([
            AdminColumn::text('id', 'ID'),
            AdminColumn::text('title', 'Название'),
              AdminColumnEditable::checkbox('enabled','да','нет')->setLabel('Включен'),
            AdminColumn::custom('По умолчанию', function($model) {
                        return $model->is_default ? 'Да' : 'Нет';
                    })
        ]);
        return $display;
    }

    public function onCreate() {
        return $this->onEdit(null);
    }

    public function onEdit($id) {
        return AdminForm::panel()->addBody([
                    AdminFormElement::text('title', 'Название'),
                    AdminFormElement::image('data->image', 'Иконка'),
                    AdminFormElement::checkbox('enabled', 'Включен')->setDefaultValue(1),
                    AdminFormElement::checkbox('is_default', 'По умолчанию')
        ]);
    }

}
