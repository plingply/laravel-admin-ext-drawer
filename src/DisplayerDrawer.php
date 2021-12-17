<?php

namespace Pling\Drawer;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Displayers\AbstractDisplayer;

class DisplayerDrawer extends AbstractDisplayer
{
    /**
     * @var string
     */
    protected $renderable;

    /** 自定义参数 */
    public $var = null;

    /**
     * @param \Closure|string $callback
     *
     * @return mixed|string
     */
    public function display($callback = null, $var = null )
    {

        $this->var = $var;

        if (is_subclass_of($callback, BaseDrawer::class)) {

            $this->renderable = $callback;

            $renderable = new $callback();
            $html = '';

            if ($renderable->sync) {
                $html = $renderable->render($this->row->id);
            }
                
            return Admin::component('drawer::index', [
                'url'     => $this->getLoadUrl(),
                'class' => $renderable->className,
                'title'   => $renderable->title,
                'position' => $renderable->position,
                'sync'   => $renderable->sync,
                'size' => $renderable->size,
                'html'    => $html,
                'key'     => $this->getKey(),
                'value'   => $this->value,
                'name'    => $this->getKey() . '-' . str_replace('.', '_', $this->getColumn()->getName()),
            ]);
        }
    }

    protected function getLoadUrl()
    {
        $renderable = str_replace('\\', '_', $this->renderable);
        $key = $this->getKey();
        $var = $this->var;
        return route('admin.handle-renderable', compact('renderable', 'key', 'var'));
    }
}
