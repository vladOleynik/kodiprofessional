<?php

namespace App\Admin\Sections;

use SleepingOwl\Admin\Contracts\FormInterface;
use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\AppAdminSection;
use SleepingOwl\Admin\Contracts\Initializable;
use \SleepingOwl\Admin\Form\Buttons\Save;
use \SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use \SleepingOwl\Admin\Form\Buttons\Cancel;

class fundamentalSettings extends AppAdminSection implements Initializable
{

    protected $model = '\App\Models\fundamentalSetting';
    protected $checkAccess = false;
    protected $title = 'Базовые настройки';
    protected $alias = 'settings';

    public function initialize()
    {

        $this->addToNavigation(1, \App\Models\FundamentalSetting::count())->setId('settings');

    }

    public function onDisplay()
    {
        $table = AdminDisplay::datatablesAsync()->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::link('name', 'Настройка')->setWidth('200px'),
                AdminColumn::text('value', 'Значение')
            )->paginate(20);
        $table->getActions()->setView(view('sleepingowl.display.toolbar'))->setPlacement('panel.heading.actions');
        return $table;
    }

    public function onEdit($id)
    {

        $form = AdminForm::panel()->addBody([
            AdminFormElement::text('var', 'Alias настройки')->setReadOnly(true),
            AdminFormElement::text('name', 'Название настройки')->required(),
            AdminFormElement::textarea('value', 'Значение')->required(),
        ]);

        $form->getButtons()->setButtons([
            'save' => (new SaveAndClose())->setText('Сохранить и закрыть'),
            'save_and_edit' => (new Save())->setText('Сохранить и продолжить редактирование'),
            'cancel' => (new Cancel())->setText('Отменить')
        ])->setPlacements([
        ]);

        return $form;
    }

    public function onCreate()
    {

        $form = AdminForm::panel()->addBody([
            AdminFormElement::text('var', 'Alias настройки')->required(),
            AdminFormElement::text('name', 'Название настройки')->required(),
            AdminFormElement::textarea('value', 'Значение')->required(),

        ]);

        $form->getButtons()->setButtons([
            'save' => (new SaveAndClose())->setText('Сохранить и закрыть'),
            'save_and_edit' => (new Save())->setText('Сохранить и продолжить редактирование'),
            'cancel' => (new Cancel())->setText('Отменить')
        ])->setPlacements([
        ]);

        return $form;
    }

    public function getCreateTitle()
    {
        return 'Создание базовой настройки';
    }

    public function getIcon()
    {
        return 'fa fa-gear';
    }

}
