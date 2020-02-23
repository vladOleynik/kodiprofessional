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

class messages extends AppAdminSection implements Initializable
{

    protected $checkAccess = false;
    protected $title = 'Сообщения';
    protected $alias = 'messages';

    public function initialize()
    {

        $this->addToNavigation(12)->setId('messages');

    }

    public function onDisplay()
    {
        $table = AdminDisplay::datatablesAsync()->setHtmlAttribute('class', 'table-primary')->setApply(function ($query) {
            $query->orderBy('id', 'desc');
        })
            ->setColumns(
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::text('email', 'Email')->setWidth('200px'),
                AdminColumn::text('msg', 'Сообщение'),
                AdminColumn::text('created_at', 'Дата')->setWidth('150px')
            )->paginate(20);

        return $table;
    }


    public function getCreateTitle()
    {
        return 'Создание базовой настройки';
    }

    public function getIcon()
    {
        return 'fa fa-newspaper-o';
    }

}
