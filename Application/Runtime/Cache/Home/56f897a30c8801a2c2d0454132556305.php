<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo ($pageTitle); ?>-<?php echo C("blogTitle");?></title>
<link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="/Application/Home/View/Index/style.css">
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/4.0.0-alpha/js/umd/modal.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body  data-spy="scroll" data-target="#navbar-example">
<nav class="navbar navbar-default">
<div class="container">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<a class="navbar-brand" href="#">Brand</a>
	</div>
	<ul class="nav navbar-nav">
		<?php $f=function(){ $rs=q("SELECT * FROM `blog_post` WHERE `type`='page' "); while($p=$rs->fetch()){ $p["title"]=htmlspecialchars($p["title"]); ?>
        <li role="presentation" <?php if(isset($page) && $page['slug']==$p['slug']): ?>class="active"<?php endif; ?> ><a href="/index.php/Home/Index/page/<?php echo ($p["slug"]); ?>"><?php echo ($p["title"]); ?></a></li>
<?php } }; $f(); ?>
	</ul>
	<form class="navbar-form navbar-right" role="search">
  <div class="form-group input-group-sm">
    <input type="text" class="form-control" placeholder="Search">
  </div>
  <button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
</form>
</div>
</nav>
<header>
<div class="container">
	    <?php if(C('blogLogo')): ?><img src="<?php echo C('blogLogo');?>" class="logo" /><?php endif; ?>
		<h3><?php echo C("blogTitle");?></h3>
	</div>
</header>
<div class="container">
    <div class="row">
        
        <div class="col-md-8">
            <article class="post">
                <h3>
                        <?php echo ($post["title"]); ?>                    
                </h3>
                <div class="post-meta">
                    日期：<?php echo (date("Y-m-d",$post["time"])); ?>，<a href="<?php echo ($author["url"]); ?>"><?php echo ($author["name"]); ?></a>
                </div>
                <div class="post-content">
                        <?php echo ($post["content"]); ?>                                        
                </div>

            </article>
            
                <form action="/index.php/Home/Index/respond/<?php echo ($post["PID"]); ?>" method="post">
            <div class="comment-main">     
            <?php if($comments): ?><ul class="comments">
                <?php if(is_array($comments)): foreach($comments as $key=>$c): ?><li>
                        <div class="comment-meta"><img class="gravatar" src="<?php echo ($c["gravatar"]); ?>" /><h4 style="display:inline-block;"><?php if($c['url']): ?><a href="<?php echo ($c["url"]); ?>"><span class="label label-info"><?php echo ($c["name"]); ?></span></a>
                        <?php else: ?>
                            <span class="label label-info"><?php echo ($c["name"]); ?></span><?php endif; ?></h4><time><?php echo (date("Y-m-d",$c["time"])); ?></time><br/></div>
                        <div class="comment-content"><?php echo ($c["content"]); ?></div>
                    
                    </li><?php endforeach; endif; ?>
                </ul><?php endif; ?>
         <div class="Input_Box">
           <div class="Input_Head"> 
           <div>名字：<input type="text" name="name" placeholder="" value="<?php echo (cookie('memberName')); ?>" required minlength="1" maxlength="100" /></div>
           <div>邮箱：<input type="email" name="email" placeholder="email:123@qq.com"value="<?php echo (cookie('memberEmail')); ?>" required  minlength="1" maxlength="100" /></div>
           <div>主页：<input type="url" name="url" placeholder="http://" value="<?php echo (cookie('memberURL')); ?>" maxlength="100" /></div>
           </div>
           <textarea class="Input_text" name="content" required></textarea>
           <div class="Input_Foot"> 
            <button type="submit" class="postBtn">提交</button>
           </div>     
         </div>   
            
        </div>
        </form>
            
        </div>
        
        <div class="col-md-4">
            <nav class="">
    <ul class="nav nav-pills nav-stacked blog_nav">
  <li role="presentation"><a href="/index.php">Home</a></li>
  <li role="presentation"><a href="/index.php/Admin">Admin</a></li>
</ul>
</nav>
<nav class="">
    <h4>最新</h4>
    <ul class="nav nav-pills nav-stacked blog_nav">
<?php $f=function(){ $rs=q("SELECT * FROM `blog_post` WHERE `type`='post' LIMIT 0,5"); while($p=$rs->fetch()){ $p["title"]=htmlspecialchars($p["title"]); ?>
        <li>
<a href="/index.php/Home/Index/post/<?php echo ($p["slug"]); ?>"><?php echo ($p["title"]); ?></a>
</li>
<?php } }; $f(); ?>
</ul>
    <h4>分类</h4>
    <ul class="nav nav-pills nav-stacked blog_nav">
<?php $f=function(){ $rs=q("SELECT * FROM `blog_meta` WHERE `type`='category' ORDER BY `order` "); while($p=$rs->fetch()){ $p["name"]=htmlspecialchars($p["name"]); ?>
        <li>
<a href="/index.php/Home/Index/category/<?php echo ($p["slug"]); ?>"><?php echo ($p["name"]); ?></a>
</li>
<?php } }; $f(); ?>
</ul>
</nav>
        </div>
    </div>
</div>
      

  </body>
  <footer>
      @Tristana.CN
  </footer>
</html>