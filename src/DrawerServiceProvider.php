<?php

namespace Pling\Drawer;

use Encore\Admin\Grid;
use Encore\Admin\Grid\Column;
use Illuminate\Support\ServiceProvider;

class DrawerServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(Drawer $extension)
    {
        if (! Drawer::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'drawer');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/laravel-admin-ext/drawer')],
                'drawer'
            );
        }
        
        Grid::init(function () {
            Column::extend('drawer', DisplayerDrawer::class);
        });
    }
}