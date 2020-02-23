<?php

namespace App\Admin\Sections\Sliders;

use SleepingOwl\Admin\Contracts\FormInterface;
use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Initializable;
use App\AppAdminSection;
use \Illuminate\Support\Facades\Input;
use \SleepingOwl\Admin\Form\Buttons\Save;
use \SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use \SleepingOwl\Admin\Form\Buttons\Cancel;
class fields extends AppAdminSection implements Initializable {

    protected $model = '\App\Models\Sliders\Fields';
    protected $checkAccess = false;
    protected $title = 'Настройки модуля';
    protected $alias = 'sliders_settings';

    public function initialize() {
        
    }

    public function onDisplay() {
        $sliderId = Input::get('slider_id');
        $display = AdminDisplay::table()
                ->setApply(function ($query) use($sliderId) {
                    $query->where('slider_id', $sliderId);
                })
                ->setHtmlAttribute('class', 'table-primary')
                ->setParameter('slider_id', $sliderId)
                ->setHtmlAttribute('class', 'table-primary')
                ->setColumns(
                AdminColumn::text('id', 'ID'), AdminColumn::text('title', 'Название')
        );

        return $display;
    }

    public function onEdit($id) {
        $sliderId = Input::get('slider_id');
        $form = AdminForm::form()->setElements([
            AdminFormElement::select('field_type', 'Тип поля', static::$_fieldTypes),
            AdminFormElement::text('title', 'Название поля'),
            AdminFormElement::text('alias', 'Alias'),
           
            AdminFormElement::hidden('slider_id')->setDefaultValue($sliderId),
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
        $sliderId = Input::get('slider_id');

        $form = AdminForm::form()->setElements([
            AdminFormElement::select('field_type', 'Тип поля', static::$_fieldTypes),
            AdminFormElement::text('title', 'Название поля'),
            AdminFormElement::text('alias', 'Alias'),
      
            AdminFormElement::hidden('slider_id')->setDefaultValue($sliderId),
        ]);

           $form->getButtons()->setButtons([
            'save' => (new SaveAndClose())->setText('Сохранить и закрыть'),
            'save_and_edit' => (new Save())->setText('Сохранить и продолжить редактирование'),
            'cancel' => (new Cancel())->setText('Отменить')
        ])->setPlacements([
        ]);
        
        return $form;
    }

    public function getCreateTitle() {
        return 'Создать поле';
    }

}
