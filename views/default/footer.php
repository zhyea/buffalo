<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="layui-row footer">
    <div class="layui-row">
        <div class="layui-col-md12 layui-col-xs12 copyright">
            &nbsp;
        </div>
        <div class="layui-col-md12 layui-col-xs12 copyright">
            2019 © 所有内容版权归版权方或原作者所有
        </div>
    </div>
</div>
</div>


<script charset="utf-8" src="../static/layui/layui.js"></script>
<script>
    layui.use(['element', 'carousel'], function () {
        let carousel = layui.carousel;
        //建造实例
        carousel.render({
            elem: '#home-carousel',
            width: '100%', //设置容器宽度,
            height: '180px',
            arrow: 'always', //始终显示箭头
        });
    });
</script>
</body>
</html>

