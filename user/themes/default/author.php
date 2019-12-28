<?php
defined('BASEPATH') OR exit('No direct script access allowed');
isset($ctx_theme) OR exit('No base url exists')
?>


<div class="container notice">
	<ol class="breadcrumb">
		<li><a href="<?= $ctx_site ?>"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
		<li><?= $name ?></li>
	</ol>
</div>

<div class="container main">
	<div class="page-header">
		<h3><span class="glyphicon glyphicon-th-list"></span> <?= $name ?></h3>
	</div>
	<div class="row category">

        <?php foreach ($works as $w): ?>
			<div class="col-md-6 col-xs-12 work">
				<div class="cover">
					<a href="<?= $ctx_site . '/fe/work/' . $w['id'] ?>">
						<img src="<?= $ctx_upload . '/' . $w['cover'] ?>" width="120px" height="156px"/>
					</a>
				</div>
				<div class="brief">
					<div class="title"><a href="<?= $ctx_site . '/fe/work/' . $w['id'] ?>"><?= $w['name'] ?></a></div>
					<div class="author"><a href><?= $w['author'] ?></a></div>
					<div class="intro"><?= substr($w['brief'], 0, 64) . '...' ?></div>
				</div>
			</div>
        <?php endforeach; ?>
		<div class="col-md-6 col-xs-12 work">
			<div class="cover">
				<img src="<?php echo $ctx_theme ?>/static/imgs/noimg.jpg" width="120px" height="162px"/>
			</div>
			<div class="brief">
				<div class="title"><a href="#">望庐山瀑布</a></div>
				<div class="author"><a href>李白</a></div>
				<div class="intro">
					日照香炉生紫烟，遥看瀑布挂前川，飞流直下三千只，疑是银河落九天。大江东去，浪淘尽，千古风流人物，遥想公瑾当年，小乔初嫁了，羽扇纶巾，雄姿英发，谈笑间樯橹灰飞烟灭
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xs-12 work">
			<div class="cover">
				<img src="<?php echo $ctx_theme ?>/static/imgs/noimg.jpg" width="120px" height="172px"/>
			</div>
			<div class="brief">
				<div class="title"><a href="#">望庐山瀑布</a></div>
				<div class="author"><a href>李白</a></div>
				<div class="intro">
					日照香炉生紫烟，遥看瀑布挂前川，飞流直下三千只，疑是银河落九天。大江东去，浪淘尽，千古风流人物，遥想公瑾当年，小乔初嫁了，羽扇纶巾，雄姿英发，谈笑间樯橹灰飞烟灭
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xs-12 work">
			<div class="cover">
				<img src="<?php echo $ctx_theme ?>/static/imgs/noimg.jpg" width="120px" height="172px"/>
			</div>
			<div class="brief">
				<div class="title"><a href="#">望庐山瀑布</a></div>
				<div class="author"><a href>李白</a></div>
				<div class="intro">
					日照香炉生紫烟，遥看瀑布挂前川，飞流直下三千只，疑是银河落九天。大江东去，浪淘尽，千古风流人物，遥想公瑾当年，小乔初嫁了，羽扇纶巾，雄姿英发，谈笑间樯橹灰飞烟灭
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xs-12 work">
			<div class="cover">
				<img src="<?php echo $ctx_theme ?>/static/imgs/noimg.jpg" width="120px" height="172px"/>
			</div>
			<div class="brief">
				<div class="title"><a href="#">望庐山瀑布</a></div>
				<div class="author"><a href>李白</a></div>
				<div class="intro">
					日照香炉生紫烟，遥看瀑布挂前川，飞流直下三千只，疑是银河落九天。大江东去，浪淘尽，千古风流人物，遥想公瑾当年，小乔初嫁了，羽扇纶巾，雄姿英发，谈笑间樯橹灰飞烟灭
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xs-12 work">
			<div class="cover">
				<img src="<?php echo $ctx_theme ?>/static/imgs/noimg.jpg" width="120px" height="172px"/>
			</div>
			<div class="brief">
				<div class="title"><a href="#">望庐山瀑布</a></div>
				<div class="author"><a href>李白</a></div>
				<div class="intro">
					日照香炉生紫烟，遥看瀑布挂前川，飞流直下三千只，疑是银河落九天。大江东去，浪淘尽，千古风流人物，遥想公瑾当年，小乔初嫁了，羽扇纶巾，雄姿英发，谈笑间樯橹灰飞烟灭.
					山舞银蛇原驰蜡象欲与天公试比高，须晴日看红妆素裹分外妖娆。唐宗宋祖时候逊风骚秦皇汉武略输文采，一代天骄成吉思汗只识弯弓射大雕
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xs-12 work">
			<div class="cover">
				<img src="<?php echo $ctx_theme ?>/static/imgs/noimg.jpg" width="120px" height="172px"/>
			</div>
			<div class="brief">
				<div class="title"><a href="#">望庐山瀑布</a></div>
				<div class="author"><a href>李白</a></div>
				<div class="intro">
					日照香炉生紫烟，遥看瀑布挂前川，飞流直下三千只，疑是银河落九天。大江东去，浪淘尽，千古风流人物，遥想公瑾当年，小乔初嫁了，羽扇纶巾，雄姿英发，谈笑间樯橹灰飞烟灭
				</div>
			</div>
		</div>
	</div>


	<div class="pagination">
        <?php
        for ($x = 1; $x <= $total + 1; $x++) {
            $active = $x == $curr ? 'class="active"' : '';
            echo '<a href="' . $ctx_site . '/fe/author/' . $author_id . '/' . $x . '" ' . $active . '>' . $x . '</a>';
        }
        ?>
	</div>
</div>
