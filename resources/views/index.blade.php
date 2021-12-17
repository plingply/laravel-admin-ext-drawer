<span class="{{ $class }} grid-drawer-{{ $name }}-btn" data-toggle="drawer" data-url="{{ $url }}" data-key="{{ $key }}">
    <a href="javascript:void(0)">{!! $value !!}</a>
 </span>
 
 <div class="drawer" class="grid-drawer-{{ $name }}">
    <div class="drawer-modal"></div>
     <div class="drawer-content {{ $position }}" style="{{ $position }} : -{{ $size }}; {{ in_array($position, ['left', 'right']) ? 'width' : 'height' }}: {{ $size }}">
        <div class="drawer-header">
            <h4 class="drawer-title">{{ $title }}</h4>
            <button type="button" class="close drawer-close-{{ $name }}" data-dismiss="drawer" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="drawer-body">
            {!! $html !!}
        </div>
    </div>
 </div>

 <style>
     .drawer{
         width: 100%;
         height: 100%;
         position: fixed;
         z-index: 3000;
         top: 0;
         left: -100%;
         overflow: hidden;
         transition: opacity .3s;
         opacity: 0;
        }

        .drawer.show {
            left: 0;
            opacity: 1;
        }
        
        .drawer-modal{
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, .7);
        }
        
        .drawer-content{
            position: absolute;
            background-color: #fff;
            padding: 0;
            box-sizing: border-box;
            transition: all .3s;
     }

     .drawer-content.left{
         top: 0;
         left: -100%;
         width: 50%;
         height: 100%;
     }

     .drawer-content.right{
         top: 0;
         right: -100%;
         width: 50%;
         height: 100%;
     }

     .drawer-content.top{
         top: -100%;
         left: 0;
         width: 100%;
         height: 50%;
     }

     .drawer-content.bottom{
         left: 0;
        bottom: -100%;
         width: 100%;
         height: 50%;
     }

     .drawer-title{
         margin-top: 0;
         font-size: 14px;
         color: #333;
         margin-bottom: 0;
     }

     .drawer-header{
        height: 32px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 8px;
     }

     .drawer-body{
         overflow: hidden;
         overflow-y: auto;
         height: calc(100vh - 32px);
         padding: 0 8px;
         box-sizing: border-box;
     }

 </style>
 

 <script>

     var drawer = $('.grid-drawer-{{ $name }}');
     var drawerBody = drawer.find('.drawer-body');
     var drawerBtn = $('.grid-drawer-{{ $name }}-btn')
     var closeBtn = $(".drawer-close-{{ $name }}")

     var load = function (url) {
 
         drawerBody.html("<div class='loading text-center' style='height:200px;'>\
                 <i class='fa fa-spinner fa-pulse fa-3x fa-fw' style='margin-top: 80px;'></i>\
             </div>");
 
         $.get(url, function (data) {
             drawerBody.html(data);
         });
     };
 
     drawerBtn.on('click', function (e) {

        $(".drawer").removeClass('show');
        drawer.addClass('show');

        drawer.find('.drawer-content').css('{{ $position }}', 0);
        @if (!$sync)
        load($(this).data('url'));
        @endif
         e.preventDefault();
     });

     closeBtn.on('click', function (e) {
        drawer.find('.drawer-content').css('{{ $position }}', '-{{ $size }}');
        setTimeout(function () {
            drawer.removeClass('show');
        }, 300)
     })

     $(".drawer-modal").on("click", function (e) {
        drawer.find('.drawer-content').css('{{ $position }}', '-{{ $size }}');
        setTimeout(function () {
            drawer.removeClass('show');
        }, 300)
     })
 </script>

 