<?php

namespace App\Admin\Sections\Sliders;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Initializable;
use Illuminate\Database\Eloquent\Model;
use App\AppAdminSection;
use \Illuminate\Support\Facades\Input;
use App\Models\Sliders\Fields;
use App\Models\Sliders\Values;
use App\Models\Sliders\Table as Slider;
use App\Core\AdminTranslate;
use \SleepingOwl\Admin\Form\Buttons\Save;
use \SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use \SleepingOwl\Admin\Form\Buttons\Cancel;

class images extends AppAdminSection implements Initializable
{

    protected $checkAccess = false;
    protected $title = 'Управление слайдами';
    protected $alias = 'slider/view';
    protected $model = '\App\Models\Sliders\Images';


    public function initialize()
    {

        $this->created(function ($config, Model $model) {
            $fieldsValues = Input::get('main');
            $fieldsArray = Fields::where('slider_id', $model->slider_id)->get();
            $fields = $fieldsArray->toArray();
            \App\Helpers\Arr::setKeys($fields, 'alias');

            if (!is_null($fieldsValues)) {
                foreach ($fieldsValues as $alias => $value) {

                    $values = new Values;
                    $values->field_id = $fields[$alias]['id'];
                    $values->slider_id = $model->slider_id;
                    $values->data_id = $model->id;
                    $values->value = $value;
                    $values->save();
                }
            }
        });

        $this->updated(function ($config, Model $model) {
            $fieldsValues = \Illuminate\Support\Facades\Input::get('main');
            $fieldsArray = Fields::where('slider_id', $model->slider_id)->get();
            $fields = $fieldsArray->toArray();
            \App\Helpers\Arr::setKeys($fields, 'alias');
            Values::where('data_id', $model->id)->where('slider_id', $model->slider_id)->forceDelete();
            foreach ($fieldsValues as $alias => $value) {
                $values = new Values;
                $values->field_id = $fields[$alias]['id'];
                $values->data_id = $model->id;
                $values->slider_id = $model->slider_id;
                $values->value = $value;
                $values->save();
            }
        });
    }

    public function onDisplay()
    {

        \Meta::addJs('admin-custom-js', resources_url('js/slider.js'), ['admin-default']);
        \Meta::addCss('admin-slider-css', resources_url('css/slider.css'), ['admin-default']);
        $sliderId = Input::get('slider_id');
        $display = AdminDisplay::tree()->setApply(function ($query) use ($sliderId) {
            $query->where('slider_id', $sliderId);
        });
        $display->setView(view('sleepingowl.display.slider'));

        return $display;
    }

    public function onEdit($id)
    {
        $model = $this->getModel()->find($id);
        $fields = Fields::where('slider_id', $model->slider_id)->get();
        $elements = [];
        $elements[] = AdminFormElement::image("path", "Изображение")->required();
        $elements[] = AdminFormElement::hidden("slider_id", $model->slider_id);
        $values = Values::where('slider_id', $model->slider_id)->where('data_id', $id)->get()->toArray();
        $values = \App\Helpers\Arr::setKeys($values, 'field_id');

        foreach ($fields as $field) {
            $element = AdminFormElement::{$field->field_type}("main[" . $field->alias . "]", $field->title)->setValueSkipped(true);
            if (isset($values[$field['id']])) {
                $element = $element->setDefaultValue($values[$field['id']]['value']);
            }

            array_push($elements, $element);
        }

        $form = AdminForm::form()->setElements($elements);

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
        $sliderId = Input::get('slider_id');
        $fields = Fields::where('slider_id', $sliderId)->get();
        $elements = [];
        $elements[] = AdminFormElement::image("path", "Изображение")->required();
        $elements[] = AdminFormElement::hidden("slider_id", $sliderId);
        foreach ($fields as $field) {
            $element = AdminFormElement::{$field->field_type}("main[" . $field->alias . "]", $field->title)->setValueSkipped(true);
            array_push($elements, $element);
        }

        $form = AdminForm::form()->setElements($elements);
        $form->getButtons()->setButtons([
            'save' => (new SaveAndClose())->setText('Сохранить и закрыть'),
            'save_and_edit' => (new Save())->setText('Сохранить и продолжить редактирование'),
            'cancel' => (new Cancel())->setText('Отменить')
        ])->setPlacements([
        ]);


        return $form;
    }

}
