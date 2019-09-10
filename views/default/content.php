<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="layui-row main">
    <div class="layui-carousel carousel" id="home-carousel">
        <div carousel-item>
            <div><img height="100%" src="<?php echo $base_url ?>/static/imgs/01.jpg" width="100%"/></div>
            <div><img height="100%" src="../static/imgs/02.jpg" width="100%"/></div>
            <div><img height="100%" src="../static/imgs/03.jpg" width="100%"/></div>
            <div><img height="100%" src="../static/imgs/04.jpg" width="100%"/></div>
        </div>
    </div>
    <div class="layui-row recommend">

        <fieldset class="layui-elem-field layui-field-title">
            <legend>推荐</legend>
        </fieldset>

        <div class="item">
            <div class="cover">
                <img src="<?php echo $base_url ?>/static/imgs/tuijian.jpg"/>
            </div>
            <div class="remark">知否知否，应是绿肥红瘦</div>
        </div>
        <div class="item">
            <div class="cover">
                <img src="../static/imgs/tuijian.jpg"/>
            </div>
            <div class="remark">作品2</div>
        </div>
        <div class="item">
            <div class="cover">
                <img src="../static/imgs/tuijian.jpg"/>
            </div>
            <div class="remark">作品3</div>
        </div>
        <div class="item">
            <div class="cover">
                <img src="../static/imgs/tuijian.jpg"/>
            </div>
            <div class="remark">作品4</div>
        </div>
        <div class="item">
            <div class="cover">
                <img src="../static/imgs/tuijian.jpg"/>
            </div>
            <div class="remark">作品5</div>
        </div>
    </div>

    <div class="layui-row popular">
        <fieldset class="layui-elem-field layui-field-title">
            <legend>热门</legend>
        </fieldset>

        <div class="layui-row category">
            <div class="catName">[分类名称] :</div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
        </div>

        <div class="layui-row category">
            <div class="catName">[分类名称] :</div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
            <div class="item">小说名称<span class="author">[作者名称]</span></div>
        </div>
    </div>
</div>
