<?php

namespace App\Admin\Sections\Catalog;

use SleepingOwl\Admin\Contracts\DisplayInterface;
use SleepingOwl\Admin\Contracts\FormInterface;
use AdminColumn;
use AdminDisplay;
use AdminDisplayFilter;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Facades\TableColumnEditable as AdminColumnEditable;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Navigation\Page;
use Illuminate\Database\Eloquent\Model;
use App\AppAdminSection;
use App\Helpers\Tree;
use \SleepingOwl\Admin\Form\Buttons\Save;
use \SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use \SleepingOwl\Admin\Form\Buttons\Cancel;

class products extends AppAdminSection implements Initializable
{


    protected $model = '\App\Models\Catalog\Product';
    protected $checkAccess = false;
    protected $title = 'Товары';
    protected $alias = 'catalog/products';

    public function initialize()
    {
        $page = \AdminNavigation::getPages()->findById('catalog');

        $page->setPages(function ($page) {
            $page->addPage((new Page(\App\Models\Catalog\Product::class))->setId('catalog_products')
                ->setPriority(1));
        });

        $this->created(function ($config, $model) {

            $category_id = request('category_id');
            if ($category_id) {
                $model->categories()->attach($category_id);
            }

            $model->meta->type = $model::TYPE;
            $model->meta->slug($model);
            $model->meta->save();
        });

        $this->updating(function ($config, Model $model) {


        });
        $this->updated(function ($config, $model) {

            $category_id = request('category_id');
            if ($category_id) {
                $model->categories()->detach();
                $model->categories()->attach($category_id);
            }
            $model->meta->slug($model);
            $model->meta->save();
        });

    }

    public function onDisplay()
    {
        $this->activate();
        $displayUrl = $this->getDisplayUrl();

        $page = \AdminNavigation::getPages()->findById('catalog_products');
        $page->setActive(true);
        \Meta::addJS('checkbox-fix', resources_url('js/checkbox-fix.js'), ['admin-default']);
        $columns = [
            AdminColumn::checkbox(),
            AdminColumn::text('id', 'Id'),
            AdminColumn::link('title', 'Название товара', 'is_draft'),
            AdminColumn::custom('Категория', function ($model) use ($displayUrl) {

                if (isset($model->categories[0]->id)) {
                    $url = $displayUrl . '?rubric=' . $model->categories[0]->id;

                    return '<a href="' . $url . '">' . $model->categories[0]->title;
                }

            }),

            AdminColumn::datetime('created_at', 'Дата создания'),
            AdminColumnEditable::text('order_by', 'Порядок сортировки')
        ];
        $rubric = request()->get('rubric');
        $allProducts = AdminDisplay::datatablesAsync()->setApply(function ($query) {
            $query->orderBy('id', 'desc');
        })->setApply(function($q) use ($rubric) {
            if (!is_null($rubric)) {
                return $q->whereHas('categories', function($q) use ($rubric) {
                    return $q->where('category_id', '=', $rubric);
                });
            }
        })->setName('allProducts')->setColumns($columns);
        //$this->addControl($allProducts);
        //$publishedProducts = AdminDisplay::datatablesAsync()->setName('publishedProducts')->getScopes()->set('published')->setColumns($columns);
        //$this->addControl($publishedProducts);
     //   $unPublishedProducts = AdminDisplay::datatablesAsync()->setName('unPublishedProducts')->getScopes()->set('unpublished')->setColumns($columns);


        $allProducts->getActions()->setPlacement('panel.heading.actions');
      //  $publishedProducts->getActions()->setPlacement('panel.heading.actions');
     //   $unPublishedProducts->getActions()->setPlacement('panel.heading.actions');
        $tabs = \AdminDisplay::tabbed();

        $allBadge = \App\Models\Catalog\Product::withTrashed()->count();
        $publishedBadge = \App\Models\Catalog\Product::published()->withTrashed()->count();
        $unPublishedBadge = \App\Models\Catalog\Product::Unpublished()->withTrashed()->count();

        $allProducts->setDisplaySearch(true);

        $tabs->setElements([
            AdminDisplay::tab($allProducts)->setLabel('Все товары')->setBadge($allBadge),
        //    AdminDisplay::tab($publishedProducts)->setLabel('Опубликованные')->setBadge($publishedBadge),
        //    AdminDisplay::tab($unPublishedProducts)->setLabel('Скрытые')->setBadge($unPublishedBadge)
        ]);

        return $tabs;

    }

    public function addControl($item)
    {
        $control = $item->getColumns()->getControlColumn();
        $showHide = new \SleepingOwl\Admin\Display\ControlLink(function (Model $model) use (&$showHide) {
            return route('admin_showhide', ['model' => 'product', 'id' => $model]);
        }, '', 100);
        $showHide->setAttributeCondition(function ($model) {
            if ($model->published) {
                return ['class' => 'btn btn-xs glyphicon btn-success glyphicon-eye-open show-hide'];
            } else {
                return ['class' => 'btn btn-xs glyphicon btn-danger glyphicon-eye-close sort'];
            }
        });
        $control->addButton($showHide);
        $control->setwidth(100);

    }

    public function onEdit($id)
    {
        $this->activate();
        $page = \AdminNavigation::getPages()->findById('catalog_products');
        $page->setActive(true);

        $form = AdminForm::panel();
        $form->setItems(
            AdminFormElement::columns()
                ->addColumn((new \SleepingOwl\Admin\Form\Columns\Column([
                    AdminFormElement::text('id', 'Id')->setReadOnly(true),
                    AdminFormElement::text('title', 'Название')->required(),
                    AdminFormElement::wysiwyg('description', 'Описание'),
                    AdminFormElement::images('images', 'Изображения'),

                ]))->setView('form.element.blog_posts.left_column')->setHtmlAttribute('class', 'left_column'))
                ->addColumn((new \SleepingOwl\Admin\Form\Columns\Column([
                    AdminFormElement::select('published', 'Статус')->setOptions([
                        0 => 'Cкрыто',
                        1 => 'Опубликовано'
                    ])->setView('form.element.blog_posts.custom_select'),
                    AdminFormElement::number('order_by', 'Сортировка'),
                    AdminFormElement::checkbox('data->new', 'Новинка'),
                    AdminFormElement::checkbox('data->popular', 'Популярный'),
                    AdminFormElement::number('sale', 'Количество для скидки'),
                    AdminFormElement::number('price', 'Цена')->setStep(0.01)->required(),
                    AdminFormElement::number('old_price', 'Старая цена')->setStep(0.01),
                    AdminFormElement::html(function ($model) use ($id) {

                        $items = Tree::all('\App\Models\Catalog\Category');

                        $category = data_get($model, 'categories');
                        if($category) {
                            $category = $category->pluck('id')->toArray();
                        } else {
                            $category = null;
                        }

                        return view('admin.blog_posts.product_rubrics', [
                            'type' => 'checkbox',
                            'showRoot' => true,
                            'items' => $items,
                            'model' => $model,
                            'category' => $category,

                        ]);
                    }),
                ]))->setView('form.element.blog_posts.right_column')));
        $form->addBody(AdminFormElement::columns()->addColumn(function () {
            return [

                AdminFormElement::text('meta.meta_title', 'Meta title')
                    ->setHtmlAttributes(['class' => 'meta-fields meta-title-field', 'data-field' => 'meta-title-field']),
                AdminFormElement::html(function () {
                    return '<input type="text" disabled="disabled" class="meta-title-length"> символов. Большинство поисковых систем видят лишь 60 символов.';
                }),
                AdminFormElement::textarea('meta.meta_description', 'Meta description')
                    ->setHtmlAttributes(['class' => 'meta-fields meta-description-field', 'data-field' => 'meta-description-field'])->setRows(3),
                AdminFormElement::html(function () {
                    return '<input type="text" disabled="disabled" class="meta-description-length"> символов. Большинство поисковых систем видят лишь 120 символов.';
                }),
                AdminFormElement::text('meta.meta_keywords', 'Meta keywords')->setHtmlAttributes(['class' => 'meta-fields meta-keywords-field', 'data-field' => 'meta-keywords-field']),
                AdminFormElement::html(function () {
                    return '<input type="text" disabled="disabled" class="meta-keywords-length"> символов.';
                }),
                AdminFormElement::hidden('meta.alias')->setHtmlAttribute('class', 'meta-alias')
            ];
        })
            ->addColumn(function () {
                return [
                    AdminFormElement::checkbox('meta.noindex', 'Добавить аргумент NOINDEX'),
                    AdminFormElement::checkbox('meta.nofollow', 'Добавить аргумент NOFOLLOW'),
                ];
            })
        );

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


}
