<?php

namespace Pling\Drawer;

use Encore\Admin\Extension;

class Drawer extends Extension
{
    public $name = 'drawer';

    public $views = __DIR__.'/../resources/views';

    public $menu = [
        'title' => 'Drawer',
        'path'  => 'drawer',
        'icon'  => 'fa-gears',
    ];
}