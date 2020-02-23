<?php

namespace App\Admin\Sections\StaticData;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Initializable;
use App\AppAdminSection;
use SleepingOwl\Admin\Navigation\Page;

class staticTexts extends AppAdminSection implements Initializable {

    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $model = '\App\Models\StaticData\staticTexts';
    protected $checkAccess = false;
    protected $title = 'Статические тексты';
    protected $alias = 'static_texts';

    public function initialize() {
        $this->addToNavigation(8)->setId('static')->setTitle('Статические материалы')->setIcon('fa fa-file-text-o');

        $page = \AdminNavigation::getPages()->findById('static');

        $page->setPages(function($page) {
            $page->addPage((new Page(\App\Models\StaticData\StaticTexts::class))->setId('static_text')
                ->setPriority(1));
        });

        $page->setPages(function($page) {
            $page->addPage((new Page(\App\Models\StaticData\StaticPages::class))->setId('static_pages')
                ->setPriority(2)->setTitle('Статические страницы'));
        });


    }

    public function onDisplay() {
        $this->activate();
        $page = \AdminNavigation::getPages()->findById('static_text');
        $page->setActive(true);
        $display = AdminDisplay::datatablesAsync()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', '#')->setWidth('30px'), AdminColumn::link('alias', 'Алиас')->setWidth('200px')
                , AdminColumn::text('value', 'Значение')
            )
            ->paginate(20);
        $display->setDisplaySearch(true);
        $tabs = \AdminDisplay::tabbed();
        $tabs->setElements([
            AdminDisplay::tab($display)->setLabel('Статик тексты')]);
        return $tabs;
    }

    public function onEdit($id) {

        return AdminForm::panel()->addBody([
            //  AdminFormElement::text('name', 'Название/описание текста'),
            AdminFormElement::text('alias', 'Алиас')->required()->setReadonly(1),
            AdminFormElement::ckeditor('value', 'Значение')->required(),
            AdminFormElement::text('id', 'ID')->setReadonly(1),
            AdminFormElement::text('created_at')->setLabel('Создано')->setReadonly(1),
        ]);
    }

    public function onCreate() {

        return AdminForm::panel()->addBody([
            //     AdminFormElement::text('name', 'Название/описание текста'),
            AdminFormElement::text('alias', 'Алиас')->required(),
            AdminFormElement::ckeditor('value', 'Значение')->required(),
        ]);
    }

    public function onDelete($id) {

    }

    public function onRestore($id) {
        return false;

    }


    public function getCreateTitle() {
        return 'Управление статическими текстами';
    }

}
