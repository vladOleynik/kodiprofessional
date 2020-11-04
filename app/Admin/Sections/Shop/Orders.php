<?php

namespace App\Admin\Sections\Shop;

use SleepingOwl\Admin\Contracts\Display\Extension\FilterInterface;
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
use App\AppAdminSection;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Navigation\Page;
use App\Models\Shop\OrderStatus;
use App\Models\Shop\Order;
use App\Models\Shop\Delivery;
use App\Models\Shop\Payment;
use Illuminate\Support\Facades\Input;

class Orders extends AppAdminSection implements Initializable
{

    protected $title = 'Заказы';
    protected $model = \App\Models\Shop\Order::class;
    protected $alias = 'shop/orders';

    public function initialize()
    {


        $this->addToNavigation(4)->setId('shop')->setTitle('Магазин')->setIcon('fa fa-newspaper-o');
        $page = \AdminNavigation::getPages()->findById('shop');

        $page->setPages(function ($page) {
            $page->addPage((new Page(\App\Models\Shop\Order::class))->setId('orders')
                ->setPriority(2)->setTitle('Заказы'));
        });

        $page->setPages(function ($page) {
            $page->addPage((new Page(\App\Models\Shop\OrderStatus::class))->setId('status')
                ->setPriority(2)->setTitle('Статусы заказов'));
        });

        $this->updating(function ($config, Model $model) {


            $order_id = request('order_id');
            $product_id = request('product_id');
            $qty = request('count');
            $price = request('price');
            $change = request('change');


            if (isset($product_id) && isset($change)) {

                $detail = \App\Models\Shop\Order\Details::find($product_id);
                $detail->update(['qty' => $qty, 'price' => $price]);

            }
            if (isset($product_id) && is_null($change)) {

                $model->details()->create([

                    'order_id' => $order_id,
                    'product_id' => $product_id,
                    'qty' => $qty,
                    'price' => $price
                ]);

            }


        });


    }

    public function onDisplay()
    {
        $this->activate();
        $page = \AdminNavigation::getPages()->findById('orders');
        $page->setActive(true);
        $statuses = OrderStatus::all();
        $tabsList = [];
        $all = $this->getOrdersDisplay();
        $all = AdminDisplay::tab($all)->setLabel('Все')->setBadge(Order::count());
        $tabsList[] = $all;
        foreach ($statuses as $status) {
            $display = $this->getOrdersDisplay();
            $display->setApply(function ($q) use ($status) {
                return $q->where('status_id', $status->id);
            })->setName('status_' . $status->id);
            $tabsList[] = AdminDisplay::tab($display)->setLabel($status->title)->setBadge(Order::where('status_id', $status->id)->count());
        }
        $tabs = AdminDisplay::tabbed();
        $tabs->setElements($tabsList);

        return $tabs;
    }

    public function onEdit($id)
    {
        \Meta::addJS('admin-jquery-custom', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', ['admin-default']);
        \Meta::addJS('admin-autocomplete', resources_url('js/autocomplete.js'), ['admin-default']);
        \Meta::addJS('admin-delete-js', resources_url('js/deleteOrder.js'), ['admin-default']);
        $order = $this->getModel()->with(['status', 'details' => function ($q) {
            return $q->with(['product']);
        }])->find($id);

        $order->payment = isset($order->data->payment) ? Payment::find($order->data->payment) : null;
        $order->delivery = isset($order->data->payment) ? Delivery::find($order->data->delivery) : null;

        $form = AdminForm::panel();
        $orderHeader = '<div style="font-weight:bold;">Заказ № ' . $id;
        if (isset($order->data->one_click)) {
            $orderHeader .= '<span style="font-weight: bold; color: green; margin-left: 5px;">(Заказ в 1 клик)</span>';
        }
        $orderHeader .= '</div>';
        $form->addHeader($orderHeader);
        $form->setHtmlAttribute('id', 'edit-order');

        $form->setItems(
            AdminFormElement::columns()
                ->addColumn((new \SleepingOwl\Admin\Form\Columns\Column([
                    \AdminFormElement::html(function () use ($order) {
                        return view('admin.shop.order.general', ['order' => $order]);
                    }),
                    \AdminFormElement::select('status_id', 'Статус заказа')
                        ->setModelForOptions(\App\Models\Shop\OrderStatus::class)
                ])))
                ->addColumn((new \SleepingOwl\Admin\Form\Columns\Column([
                    AdminFormElement::html(function () use ($order) {
                        return view('admin.shop.order.account', ['order' => $order]);
                    })
                ])))
                ->addColumn((new \SleepingOwl\Admin\Form\Columns\Column([
                    AdminFormElement::html(function () use ($order) {
                        return view('admin.shop.order.info', ['order' => $order]);
                    })
                ])))->addColumn((new \SleepingOwl\Admin\Form\Columns\Column([])))
        );


        $form->addBody(AdminFormElement::columns()->addColumn(new \SleepingOwl\Admin\Form\Columns\Column([
            AdminFormElement::html(function () use ($order) {
                return view('admin.shop.order.items', ['order' => $order]);
            })
        ])));

        return $form;
    }

    public function getOrdersDisplay()
    {

        $display = AdminDisplay::datatables();
        //dd(get_class_methods($display));

        $display->setColumns([
            AdminColumn::text('id', 'ID')->setWidth(50),
            AdminColumn::text('user.name', 'Имя')->setWidth(50),
            AdminColumn::text('user.email', 'Почта')->setWidth(50),
            AdminColumn::datetime('time_set_delivery', 'Время отправки заказа')->setWidth(50),
            AdminColumn::custom('Сумма заказа', function ($model) {
                $sum = 0;
                foreach ($model->details as $v) {
                    $sum += $v['qty'] * $v['price'];
                }
                return $sum;
            })->setWidth(50),
            AdminColumnEditable::select('status_id', 'Статус заказа')->setModelForOptions(\App\Models\Shop\OrderStatus::class)->setWidth(50),
            AdminColumn::datetime('created_at', 'Дата заказа')->setWidth(50),
        ])->setApply(function ($q) {
            return $q->orderBy('created_at', 'desc');
        });
        $display->setColumnFilters([
            null,
            AdminColumnFilter::text()->setPlaceholder('Введите Имя')->setOperator(FilterInterface::CONTAINS),
            AdminColumnFilter::text()->setPlaceholder('Введите e-mail')->setOperator(FilterInterface::CONTAINS),
        ]);
        $display->getColumnFilters()->setPlacement('table.header');
        $display->setHtmlAttribute('style', 'width:200px')->setHtmlAttribute('class', 'order-centerlink');
        return $display;
    }


}
