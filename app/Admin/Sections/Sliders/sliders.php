<?php

namespace App\Admin\Sections\Sliders;

use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Initializable;
use Illuminate\Database\Eloquent\Model;
use App\AppAdminSection;
use \SleepingOwl\Admin\Form\Buttons\Save;
use \SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use \SleepingOwl\Admin\Form\Buttons\Cancel;
class sliders extends AppAdminSection implements Initializable {

    protected $checkAccess = false;
    protected $title = 'Управление слайдерами';
    protected $alias = 'sliders';
    protected $model = '\App\Models\Sliders\Table';
    protected $controllerClass = '\App\Http\Controllers\Sliders\Admin\SliderController';

    public function initialize() {
        $this->addToNavigation(9)->setId('sliders')->setTitle('Управление слайдерами')->setIcon('fa fa-hand-o-right');
    }

    public function onDisplay() {
        $display = AdminDisplay::table()
                ->setHtmlAttribute('class', 'table-primary')
                ->setColumns(
                AdminColumn::text('id', 'ID'), AdminColumn::text('title', 'Название')
        );
        $control = $display->getColumns()->getControlColumn();
        $control->setHtmlAttribute('width', 200);
        $link = new \SleepingOwl\Admin\Display\ControlLink(function (Model $model) {
            return '/' . \Config::get('sleeping_owl.url_prefix') . '/sliders_settings?slider_id=' . $model->getKey();
        }, '', 100);
        $link->setIcon('fa fa-cogs');
        $link->setHtmlAttribute('class', 'btn-primary');
        $control->addButton($link);
        $control = $display->getColumns()->getControlColumn();
        $control->setHtmlAttribute('width', 200);
        $link = new \SleepingOwl\Admin\Display\ControlLink(function (Model $model) {
            return '/' . \Config::get('sleeping_owl.url_prefix') . '/slider/view?slider_id=' . $model->getKey();
        }, '', 100);
        $link->setIcon('fa fa-eye');
        $link->setHtmlAttribute('class', 'btn-primary');
        $control->addButton($link);

        return $display;
    }

    public function onEdit($id) {
        $form = AdminForm::form()->setElements([
            AdminFormElement::text('title', 'Название слайдера')->required(),
       
        ]);
        
             $form->getButtons()->setButtons([
            'save' => (new SaveAndClose())->setText('Сохранить и закрыть'),
            'save_and_edit' => (new Save())->setText('Сохранить и продолжить редактирование'),
            'cancel' => (new Cancel())->setText('Отменить')
        ])->setPlacements([
        ]);
          
        
        return $form;
    }

    public function onCreate() {
        $form = AdminForm::form()->setElements([
            AdminFormElement::text('title', 'Название слайдера')->required(),
            AdminFormElement::text('alias', 'Alias')->required(),
           
        ]);

             $form->getButtons()->setButtons([
            'save' => (new SaveAndClose())->setText('Сохранить и закрыть'),
            'save_and_edit' => (new Save())->setText('Сохранить и продолжить редактирование'),
            'cancel' => (new Cancel())->setText('Отменить')
        ])->setPlacements([
        ]);
          
        
        return $form;
    }

    public function onDelete($id) {
        
    }

    public function onRestore($id) {
        
    }

    public function getCreateTitle() {
        return 'Создать слайдер';
    }

}
