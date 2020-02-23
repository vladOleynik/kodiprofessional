<?php

namespace App\Admin\Sections\Menu;

use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Initializable;
use App\AppAdminSection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use \SleepingOwl\Admin\Form\Buttons\Save;
use \SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use \SleepingOwl\Admin\Form\Buttons\Cancel;
class menuItems extends AppAdminSection implements Initializable {

    protected $model = '\App\Models\Menu\Items';
    protected $checkAccess = false;
    protected $title = 'Пункты меню';
    protected $alias = "menu/view";

    public function initialize() {
        $this->creating(function($config, Model $model) {
            $model->menu_id = Input::get('menu_id');
            $model->parent_id = request('parent_id');

        });
    }

    public function onDisplay() {
            $display = AdminDisplay::tree();
        $extenshion = $display->extend('tree_extension', new \App\Display\Extension\TreeExtension());
        $display->setMaxDepth(1)->setView(view('sleepingowl.display.menu'));
 $display->setHtmlAttribute('data-orderable', true);

        return $display;
    }

    public function onEdit($id) {

        $form = AdminForm::panel()->addBody([
                    AdminFormElement::text('title', 'Название пункта меню')->required(),
                    AdminFormElement::text('url', 'URL')->required(),
                    AdminFormElement::select('target', 'Target', ['_self','_blank'])->required(),

                   
            
                    
                           
        ]);
        
         $form->getButtons()->setButtons([
            'save' => new SaveAndClose(),
            'save_and_edit' => (new Save())->setText('Сохранить и продолжить редактирование'),
            'cancel' => (new Cancel())
        ])->setPlacements([
        ]);
         
         return $form;
        
        
    }

    public function onCreate() {
       
           $form =  AdminForm::panel()->addBody([
                    AdminFormElement::text('title', 'Название пункта меню')->required(),
                    AdminFormElement::text('url', 'URL')->required(),
                    AdminFormElement::select('target', 'Target', ['_self','_blank'])->required(),
                    AdminFormElement::hidden('menu_id')->setDefaultValue(Input::get('menu_id')),
                         
        ]);
                                    
                                    
                                       
         $form->getButtons()->setButtons([
            'save' => new SaveAndClose(),
            'save_and_edit' => (new Save())->setText('Сохранить и продолжить редактирование'),
            'cancel' => (new Cancel())
        ])->setPlacements([
        ]);
         
         return $form;
                                    
    }

    public function getCreateTitle() {
        return 'Управление пунктами меню';
    }

}
