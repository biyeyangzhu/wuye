<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"D:\www\2think\public/../application/user/view/default/login\index.html";i:1511701813;s:70:"D:\www\2think\public/../application/user/view/default/base\common.html";i:1511687117;s:67:"D:\www\2think\public/../application/user/view/default/base\var.html";i:1496373782;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo config('WEB_SITE_TITLE'); ?></title>
<link href="__STATIC__/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="__STATIC__/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="__STATIC__/bootstrap/css/docs.css" rel="stylesheet">
<link href="__STATIC__/bootstrap/css/twothink.css" rel="stylesheet">

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="__STATIC__/bootstrap/js/html5shiv.js"></script>
<![endif]-->

<!--[if lt IE 9]>
<script type="text/javascript" src="__STATIC__/jquery-1.10.2.min.js"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script type="text/javascript" src="__STATIC__/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="__STATIC__/bootstrap/js/bootstrap.min.js"></script>
<!--<![endif]-->
<!-- 页面header钩子，一般用于加载插件CSS文件和代码 -->
<?php echo hook('pageHeader'); ?>
</head>
<body>
	<!-- 头部 -->

	<!-- /头部 -->
	
	<!-- 主体 -->
	
<link href="__STATIC__/cute/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="__STATIC__/cute/css/style.css" rel="stylesheet">

	<div id="main-container" class="container">
	    <div class="row">
	         
	        
<section>
  <div class="span12">
    <form class="login-form" action="" method="post">
      <div class="control-group">
        <label class="control-label" for="inputEmail">用户名</label>
        <div class="controls">
          <input type="text" id="inputEmail" class="span3" placeholder="请输入用户名"  ajaxurl="/member/checkUserNameUnique.html" errormsg="请填写1-16位用户名" nullmsg="请填写用户名" datatype="*1-16" value="" name="username">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputPassword">密码</label>
        <div class="controls">
          <input type="password" id="inputPassword"  class="span3" placeholder="请输入密码"  errormsg="密码为6-20位" nullmsg="请填写密码" datatype="*6-20" name="password">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputPassword">验证码</label>
        <div class="controls">
          <input type="text" id="inputPassword" class="span3" placeholder="请输入验证码"  errormsg="请填写5位验证码" nullmsg="请填写验证码" datatype="*5-5" name="verify">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label"></label>
        <div class="controls verifyimg">
          <?php echo captcha_img(); ?>
        </div>
        <div class="controls Validform_checktip text-warning"></div>
      </div>
      <div class="control-group">
        <div class="controls">
          <label class="checkbox">
            <input type="checkbox"> 自动登陆
          </label>
          <button type="submit" class="btn">登 陆</button>
        </div>
      </div>
    </form>
  </div>
</section>
<nav class="navbar navbar-default navbar-fixed-bottom">
  <div class="container-fluid text-center">
    <div class="col-xs-3">
      <p class="navbar-text"><a href="<?php echo url('home/index/index'); ?>" class="navbar-link">首页</a></p>
    </div>
    <div class="col-xs-3">
      <p class="navbar-text"><a href="fuwu.html" class="navbar-link">服务</a></p>
    </div>
    <div class="col-xs-3">
      <p class="navbar-text"><a href="faxian.html" class="navbar-link">发现</a></p>
    </div>
    <div class="col-xs-3">
      <p class="navbar-text"><a href="<?php echo url('user/login/login'); ?>" class="navbar-link">我的</a></p>
    </div>
  </div>
</nav>

	    </div>
	</div>

	<script type="text/javascript">
	    $(function(){
	        $(window).resize(function(){
	            $("#main-container").css("min-height", $(window).height() - 343);
	        }).resize();
	    })
	</script>
	<!-- /主体 -->

	<!-- 底部 -->
	


	<script type="text/javascript">
(function(){
	var ThinkPHP = window.Think = {
		"ROOT"   : "__ROOT__", //当前网站地址
		"APP"    : "__APP__", //当前项目地址
		"PUBLIC" : "__PUBLIC__", //项目公共目录地址
		"DEEP"   : "<?php echo config('URL_PATHINFO_DEPR'); ?>", //PATHINFO分割符
		"MODEL"  : ["<?php echo config('URL_MODEL'); ?>", "<?php echo config('URL_CASE_INSENSITIVE'); ?>", "<?php echo config('URL_HTML_SUFFIX'); ?>"],
		"VAR"    : ["<?php echo config('VAR_MODULE'); ?>", "<?php echo config('VAR_CONTROLLER'); ?>", "<?php echo config('VAR_ACTION'); ?>"]
	}
})();
</script>
	
<script type="text/javascript">

    $(document)
        .ajaxStart(function(){
            $("button:submit").addClass("log-in").attr("disabled", true);
        })
        .ajaxStop(function(){
            $("button:submit").removeClass("log-in").attr("disabled", false);
        });


    $("form").submit(function(){
        var self = $(this);
        $.post(self.attr("action"), self.serialize(), success, "json");
        return false;

        function success(data){
            if(data.code){
                window.location.href = data.url;
            } else {
                self.find(".Validform_checktip").text(data.msg);
                //刷新验证码
                $(".verifyimg img").click();
            }
        }
    });

    $(function(){
        //刷新验证码
        var verifyimg = $(".verifyimg img").attr("src");
        $(".verifyimg img").click(function(){
            if( verifyimg.indexOf('?')>0){
                $(".verifyimg img").attr("src", verifyimg+'&random='+Math.random());
            }else{
                $(".verifyimg img").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
            }
        });
    });
</script>
 <!-- 用于加载js代码 -->
	<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
	<?php echo hook('pageFooter', 'widget'); ?>
	<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
		
	</div>

	<!-- /底部 -->
</body>
</html>
