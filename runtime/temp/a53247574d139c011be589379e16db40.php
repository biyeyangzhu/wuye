<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"D:\www\2think\public/../application/home/view/default/service\index.html";i:1511772558;s:66:"D:\www\2think\public/../application/home/view/default/nav\nav.html";i:1512010775;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="__STATIC__/cute/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="__STATIC__/cute/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .main{margin-bottom: 60px;}
        .indexLabel{padding: 10px 0; margin: 10px 0 0; color: #fff;}
    </style>
</head>
<body>
<div class="main">
    <!--导航部分-->
    <nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="container-fluid text-center">
        <div class="col-xs-3">
            <p class="navbar-text"><a href="<?php echo url('home/index/index'); ?>" class="navbar-link">首页</a></p>
        </div>
        <div class="col-xs-3">
            <p class="navbar-text"><a href="<?php echo url('home/service/service'); ?>" class="navbar-link">服务</a></p>
        </div>
        <div class="col-xs-3">
            <p class="navbar-text"><a href="<?php echo url('home/index/index'); ?>" class="navbar-link">发现</a></p>
        </div>
        <div class="col-xs-3">
            <p class="navbar-text"><a href="<?php echo url('user/login/center'); ?>" class="navbar-link">我的</a></p>
        </div>
    </div>
</nav>
    <!--导航结束-->
    <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
    <div class="container-fluid">
        <div class="row noticeList">
            <a href="<?php echo url('detail?id='.$list['id']); ?>">
            <div class="col-xs-2">
                <img class="noticeImg" src="__ROOT__<?php echo get_cover_path($data['cover_id']); ?>" />
            </div>
            <div class="col-xs-10">
                <p class="title"><?php echo $list['title']; ?></p>
                <p class="intro"><?php echo $list['description']; ?></p>
                <p class="info">浏览: <?php echo $list['view']; ?> <span class="pull-right"><?php echo $list['create_time']; ?></span> </p>
            </div>
            </a>
        </div>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; else: ?>
    <td colspan="6" class="text-center"> aOh! 暂时还没有内容! </td>
    <?php endif; ?>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="__STATIC__/cute/jquery-1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="__STATIC__/cute/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>