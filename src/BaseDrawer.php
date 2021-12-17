<?php

namespace Pling\Drawer;

use Illuminate\Contracts\Support\Renderable;

abstract class BaseDrawer implements Renderable
{

    /** 标题 */
    public $title = '标题';

    /** 弹出位置 */
    public $position = 'left';

    /** 是否同步 */
    public $sync = false;

    /** 内容区域宽度 或高度 */
    public $size = '400px';

    /** 页面按钮文本 */
    public $text = '按钮';

    /** 页面按钮class名称 */
    public $className = 'btn-drawer';

    /** 自定义参数 */
    public $var = null;

    public function __construct($var = null)
    {
        $this->var = $var ?? request()->var ?? null;
    }

    public function render($row = null)
    {
        return $this->view($row);
    }

    abstract public function view($row);
    
}