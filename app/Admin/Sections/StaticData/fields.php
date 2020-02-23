<?php

namespace App\Admin\Sections\StaticData;

use SleepingOwl\Admin\Contracts\DisplayInterface;
use SleepingOwl\Admin\Contracts\FormInterface;
use AdminColumn;
use SleepingOwl\Admin\Facades\TableColumnEditable as AdminColumnEditable;
use AdminDisplay;
use AdminDisplayFilter;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Facades\TableColumnFilter as AdminColumnFilter;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Contracts\Form\FormButtonsInterface as FormButtonsInterface;
use App\AppAdminSection;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Navigation\Page;
use \Illuminate\Support\Facades\Input;

/**
 * Description of fields
 *
 * @author php-jun
 */
class fields extends AppAdminSection implements Initializable {

    /**
     * @var \App\Models\Core\System\Fields\Table
     */
    protected $model = '\App\Models\Core\System\Fields\Table';

    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * Заголовок раздела и название пункта в меню
     * @var string
     */
    protected $title = 'Настройки модуля';

    /**
     * URL по которому будет доступен раздел
     * @var string
     */
    protected $alias = 'static_settings';

    /**
     * Initialize class.
     */
    public function initialize() {
//        dd('sdasdsa');
    }

    /**
     * @return Первичная отображаемая таблица
     */
    public function onDisplay() {
        $tabs = AdminDisplay::tabbed();

        $element = AdminDisplay::datatables()
                ->setOrder([[1, 'asc']])
                ->setParameter('type', 'static_pages')
                ->setHtmlAttribute('class', 'table-primary')
                ->setColumns(
                AdminColumn::text('id', 'ID'), AdminColumn::order(), AdminColumn::text('title', 'Заголовок')
        );

        $tabs->addElement(AdminDisplay::tab($element)->setLabel('Статические страницы'));

        return $tabs;
    }

    /**
     * @param int $id
     * @return FormInterface
     */
    public function onEdit($id) {
        $type = Input::get('type');

        $form = AdminForm::form()->setElements([
            AdminFormElement::select('field_type', 'Тип поля', static::$_fieldTypes),
            AdminFormElement::text('title', 'Название поля'),
            AdminFormElement::text('alias', 'Alias'),
            AdminFormElement::text('class', 'Классы'),
            AdminFormElement::hidden('module')->setDefaultValue('static'),
            AdminFormElement::hidden('type')->setDefaultValue($type),
        ]);

        return $form;
    }

    /**
     * @return FormInterface
     */
    public function onCreate() {
        $type = Input::get('type');

        $form = AdminForm::form()->setElements([
            AdminFormElement::select('field_type', 'Тип поля', static::$_fieldTypes),
            AdminFormElement::text('title', 'Название поля'),
            AdminFormElement::text('alias', 'Alias'),
            AdminFormElement::text('class', 'Классы'),
            AdminFormElement::hidden('module')->setDefaultValue('static'),
            AdminFormElement::hidden('type')->setDefaultValue($type),
        ]);

        return $form;
    }

    public function getCreateTitle() {
        return 'Настройки раздела';
    }

}
