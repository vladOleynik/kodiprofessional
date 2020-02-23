<?php

namespace App\Admin\Sections\Menu;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Initializable;
use App\AppAdminSection;
use \SleepingOwl\Admin\Form\Buttons\Save;
use \SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use \SleepingOwl\Admin\Form\Buttons\Cancel;

class menus extends AppAdminSection implements Initializable
{

    protected $model = '\App\Models\Menu\Table';
    protected $checkAccess = false;
    protected $title = 'Управление меню';
    protected $alias = 'menu';

    public function initialize()
    {
        $this->addToNavigation(6)->setId('menu')->setIcon('fa fa-newspaper-o');
    }

    public function onDisplay()
    {
        $display = AdminDisplay::table()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', 'ID'), AdminColumn::text('title', 'Название')
            );
        $control = $display->getColumns()->getControlColumn();
        $control->setHtmlAttribute('width', 200);
        $link = new \SleepingOwl\Admin\Display\ControlLink(function (\Illuminate\Database\Eloquent\Model $model) {
            return '/' . \Config::get('sleeping_owl.url_prefix') . '/menu/view?menu_id=' . $model->getKey();
        }, '', 100);
        $link->setIcon('fa fa-eye');
        $link->setHtmlAttribute('class', 'btn-primary');
        $control->addButton($link);

        return $display;
    }

    public function onEdit($id)
    {
        $form = AdminForm::panel()->addBody([
            AdminFormElement::text('title', 'Название меню')->required(),
            AdminFormElement::text('alias', 'Alias')->required()
        ]);

        $form->getButtons()->setButtons([
            'save' => new SaveAndClose(),
            'save_and_edit' => (new Save())->setText('Сохранить и продолжить редактирование'),
            'cancel' => (new Cancel())
        ])->setPlacements([
        ]);

        return $form;


    }

    public function onCreate()
    {
        return $this->onEdit(null);
    }

    public function getCreateTitle()
    {
        return 'Создание меню';
    }

}
