<?php

namespace App\Providers;

use App\View\Components\Form\Button;
use App\View\Components\Form\Checkbox;
use App\View\Components\Form\Input;
use App\View\Components\Form\Select;
use App\View\Components\Form\TextArea;
use App\View\Components\Layout\Card;
use App\View\Components\Layout\SidebarMenu;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ComponentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Form Component
        Blade::component('button', Button::class);
        Blade::component('checkbox', Checkbox::class);
        Blade::component('input', Input::class);
        Blade::component('select', Select::class);
        Blade::component('textarea', TextArea::class);

        // Layout Component
        Blade::component('card', Card::class);
        Blade::component('sidebar-menu', SidebarMenu::class);
    }
}
