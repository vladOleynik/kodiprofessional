<?php

namespace App\Providers;

use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{

    protected $widgets = [
            \App\Admin\Widgets\NavigationUserBlock::class
    ];

    /**
     * @var array
     */
    protected $sections = [
        \App\Models\FundamentalSetting::class => \App\Admin\Sections\fundamentalSettings::class,
        \App\Models\Sliders\Table::class => \App\Admin\Sections\Sliders\sliders::class,
        \App\Models\Sliders\Fields::class => \App\Admin\Sections\Sliders\fields::class,
        \App\Models\Sliders\Images::class => \App\Admin\Sections\Sliders\images::class,
        \App\Models\Menu\Table::class => \App\Admin\Sections\Menu\menus::class,
        \App\Models\Menu\Items::class => \App\Admin\Sections\Menu\menuitems::class,
        \App\Models\StaticData\StaticPages::class => \App\Admin\Sections\StaticData\staticPages::class,
        \App\Models\StaticData\StaticTexts::class => \App\Admin\Sections\StaticData\staticTexts::class,
        \App\Models\Shop\Order::class=>\App\Admin\Sections\Shop\Orders::class,
        \App\Models\Shop\OrderStatus::class=>\App\Admin\Sections\Shop\OrdersStatuses::class,
        \App\Models\Catalog\Category::class=>\App\Admin\Sections\Catalog\categories::class,
        \App\Models\Catalog\Product::class=>\App\Admin\Sections\Catalog\products::class,
        \App\Models\FormMessage::class=>\App\Admin\Sections\messages::class,
        \App\Models\Seo\GlobalMeta::class=>\App\Admin\Sections\GlobalMeta::class

    ];

    /**
     * Register sections.
     *
     * @return void
     */
    public function boot(\SleepingOwl\Admin\Admin $admin)
    {

        $widgetsRegistry = $this->app[\SleepingOwl\Admin\Contracts\Widgets\WidgetsRegistryInterface::class];

        foreach ($this->widgets as $widget) {
            $widgetsRegistry->registerWidget($widget);
        }

        parent::boot($admin);
    }
}
