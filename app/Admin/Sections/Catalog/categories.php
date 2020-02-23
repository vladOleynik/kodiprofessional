<?php

namespace App\Admin\Sections\Catalog;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Initializable;
use App\AppAdminSection;
use SleepingOwl\Admin\Navigation\Page;
use \SleepingOwl\Admin\Form\Buttons\Save;
use \SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use \SleepingOwl\Admin\Form\Buttons\Cancel;
use App\Helpers\Tree;

class categories extends AppAdminSection implements Initializable
{

    protected $alias = 'catalog/categories';
    protected $model = \App\Models\Catalog\Category::class;
    protected $title = 'Категории';

    public function initialize()
    {

        $this->navigation();
        $this->creating(function ($config, $model) {

            $parentId = request()->only('parent_id')['parent_id'] ?? null;
            $model->parent_id = $parentId;
        });

        $this->created(function ($config, $model) {

            $model->meta->type = $model::TYPE;
            $model->meta->slug($model);
            $model->meta->save();
            $model::fixTree();
        });

        $this->updating(function ($config, $model) {

            $parentId = request()->only('parent_id')['parent_id'] ?? null;
            if (!empty($parentId)) {
                $model->parent_id = $parentId;
            }

        });

        $this->updated(function ($config, $model) {

            if (!mb_strlen($model->meta->alias)) {
                $model->meta->slug($model);
            }
            $model::fixTree();
        });

    }

    public function onDisplay()
    {

        $createUrl = $this->getCreateUrl();
        $display = AdminDisplay::tree();
        $display->setMaxDepth(3)->setView(view('sleepingowl.display.category', ['model' => $this->model, 'createUrl' => $createUrl]));
        return $display;

    }

    public function onEdit($id)
    {

        \Meta::addJS('admin-alias', resources_url('js/alias.js'), ['admin-default']);

        $form = AdminForm::panel();
        $form->setItems(
            AdminFormElement::columns()
                ->addColumn((new \SleepingOwl\Admin\Form\Columns\Column([
                    AdminFormElement::text('title', 'Название')->required(),
                    AdminFormElement::ckeditor('description', 'Описание'),
                    AdminFormElement::text('meta.meta_title', 'Meta title'),
                    AdminFormElement::textarea('meta.meta_description', 'Meta description')->setRows(2),
                    AdminFormElement::image('images', 'Изображения'),
                    AdminFormElement::text('meta.meta_keywords', 'Meta keywords'),
                ]))
                    ->setView('form.element.blog_posts.left_column')->setHtmlAttribute('class', 'left_column'))
                ->addColumn((new \SleepingOwl\Admin\Form\Columns\Column([
                    AdminFormElement::select('published', 'Статус')->setOptions([
                        0 => 'Cкрыто',
                        1 => 'Опубликовано'
                    ])->setDefaultValue(0)->setView('form.element.blog_posts.custom_select'),
                    AdminFormElement::checkbox('data->main', 'Показать на главной'),
                    AdminFormElement::number('data->number', 'Номер блока'),
                    AdminFormElement::html(function ($model) use ($id) {
                        $items = Tree::all($this->model);
                        return view('admin.catalog.categories_rubrics', [
                            'type' => 'radio',
                            'items' => $items,
                            'model' => $model,
                            'category' => $model->parent_id ?? 0,

                        ]);
                    })
                ]))->setView('form.element.blog_posts.right_column')));


        $form->getButtons()->setButtons([
            'save' => new SaveAndClose(),
            'save_and_edit' => (new Save())->setText('Сохранить и продолжить редактирование'),
            'cancel' => (new Cancel())
        ]);

        return $form;

    }

    public function onCreate()
    {

        return $this->onEdit(null);
    }

    private function navigation()
    {

        $this->addToNavigation(2)->setId('catalog')->setTitle('Каталог')->setIcon('fa fa-newspaper-o');
        $page = \AdminNavigation::getPages()->findById('catalog');
        $page->setPages(function ($page) {
            $page->addPage((new Page(\App\Models\Catalog\Category::class))
                ->setId('catalog_categories')
                ->setPriority(2))->setTitle('Категории');
        });
    }


}
