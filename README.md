laravel-admin extension Drawer
======

抽屉组件使用说明：

TsetDrawer 实现 BaseDrawer

1 页面任意点使用: 

$html = (new ButtonDrawer(TsetDrawer::class, $var))->render();

2 grid使用

$grid->column('corp_id', '企业名称')->display(function() {
    return $this->corp_id . '<br/>' . $this->corp_name;
})->drawer(TsetDrawer::class, $var);

在grid中，可以传入自定义参数, 在BaseDrawer的实例中 使用 $this->var 获取参数

