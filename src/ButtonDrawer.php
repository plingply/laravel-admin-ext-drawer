<?php

namespace Pling\Drawer;

use Encore\Admin\Admin;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Str;

class ButtonDrawer implements Renderable
{

    protected $key = '';
    protected $drawer = null;

    public function __construct($drawer = null, string $key = null)
    {
        if (is_subclass_of($drawer, BaseDrawer::class)) {
            $this->drawer = $drawer;
            $this->key = $key ? $key : ('drawer_' . Str::uuid());
        }
        return $this;
    }

    public function getKey()
    {
        return $this->key;
    }

    /**
     * Render the chart.
     *
     * @return string
     */
    public function render()
    {
        $drawer = new $this->drawer();
        $text = $drawer->text;
        if ($this->drawer) {
            $html = '';
            if($drawer->sync){
                $html = $drawer->render($this->key);
            }
            return Admin::component('drawer::index', [
                'url'     => $this->getLoadUrl(),
                'class' => $drawer->className,
                'title'   => $drawer->title,
                'position' => $drawer->position,
                'sync'   => $drawer->sync,
                'size' => $drawer->size,
                'html'    => $html,
                'key'     => $this->getKey(),
                'value'   => $text,
                'name'    => $this->getKey(),
            ]);
        }
    }

    private function getLoadUrl()
    {
        $renderable = str_replace('\\', '_', $this->drawer);
        $key = $this->getKey();
        return route('admin.handle-renderable', compact('renderable', 'key'));
    }
}
