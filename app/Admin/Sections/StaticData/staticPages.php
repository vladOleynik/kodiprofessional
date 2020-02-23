<?php

namespace App\Admin\Sections\StaticData;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Initializable;
use App\AppAdminSection;
use AdminColumnEditable;
use \SleepingOwl\Admin\Form\Buttons\Save;
use \SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use \SleepingOwl\Admin\Form\Buttons\Cancel;

class staticPages extends AppAdminSection implements Initializable
{

    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $model = '\App\Models\StaticData\staticPages';
    protected $checkAccess = false;
    protected $title = 'Статические страницы';
    protected $alias = 'stat_pages';

    public function initialize()
    {

        $this->created(function ($config, $model) {
// dd($model);
            $model->meta->slug($model);
            $model->meta->type = $model::TYPE;
            // $model->meta->module = $model::MODULE;
            $model->meta->save();
        });

        $this->updating(function ($config, $model) {


            $model->meta->slug($model);

        });

    }

    public function onDisplay()
    {
        $this->activate();
        $page = \AdminNavigation::getPages()->findById('static_pages');
        $page->setActive(true);
        $display = AdminDisplay::datatables()->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', '#'),
                AdminColumn::text('title', 'Название'),
                AdminColumnEditable::checkbox('published', 'Да', 'Нет')->setLabel('Опубликовано')
            )->paginate(20);
        return $display;
    }

    public function onCreate()
    {
        return $this->onEdit(null);
    }

    public function onEdit($id)
    {
        $this->activate();
        $form = AdminForm::panel();
        $form->setItems(
            AdminFormElement::columns()
                ->addColumn((new \SleepingOwl\Admin\Form\Columns\Column([
                    AdminFormElement::text('title', 'Название')->required(),
                    AdminFormElement::wysiwyg('content', 'Содержание')
                        ->setHeight(220)->required(),
                ]))->setView('form.element.blog_posts.left_column')->setHtmlAttribute('class', 'left_column'))
                ->addColumn((new \SleepingOwl\Admin\Form\Columns\Column([
                    AdminFormElement::select('published', 'Статус')->setHtmlAttribute('class', 'foo')->setOptions([
                        0 => 'Черновик',
                        1 => 'Опубликовано'
                    ])->setDefaultValue(0)->setView('form.element.blog_posts.custom_select'),

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
            'save' => (new SaveAndClose())->setText('Сохранить и закрыть'),
            'save_and_edit' => (new Save())->setText('Сохранить и продолжить редактирование'),
            'cancel' => (new Cancel())->setText('Отменить')
        ])->setPlacements([
        ]);


        return $form;
    }


}
