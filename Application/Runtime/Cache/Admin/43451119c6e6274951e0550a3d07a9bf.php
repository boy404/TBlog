<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ($siteTitle); ?></title>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Application/Admin/View/layout/style.css">
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/4.0.0-alpha/js/umd/modal.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/simditor-2.3.6/styles/simditor.css" />
    <script type="text/javascript" src="/Public/simditor-2.3.6/scripts/module.js"></script>
    <script type="text/javascript" src="/Public/simditor-2.3.6/scripts/hotkeys.js"></script>
    <script type="text/javascript" src="/Public/simditor-2.3.6/scripts/uploader.js"></script>
    <script type="text/javascript" src="/Public/simditor-2.3.6/scripts/simditor.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
      
<div class="modal fade" id="exampleModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">提示</h4>
			</div>
			<div class="modal-body">
				<p>
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				<a class="btn btn-primary" id="deleteBottom">删除</a>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<nav class="navbar navbar-default">
  <div class="container">
      <h3 class="center-block">不点博客豪华加强版 v9.99999</h3>
    </div>
</nav>
<div class="container">
	<div class="row">
        
		<div class="col-md-8">
		    <ol class="breadcrumb">
  <li><a href="/index.php/Admin/Index">管理首页</a></li>
  <li><a href="/index.php/Admin/Post/meta">分类管理</a></li>
  <?php if($meta): ?><li class="active">修改: <?php echo ($meta["name"]); ?></li>
  <?php else: ?>
      <li class="active">新建分类</li><?php endif; ?>
  
</ol>
<div class="main">
<form action="/index.php/Admin/Post/metaEdit/<?php echo ($meta["MID"]); ?>" method="post">
    <label for="metaName">分类名称</label>
	<div class="form-group">
			<input type="text" name="name" id="metaName" class="form-control" value="<?php echo ($meta["name"]); ?>" placeholder="分类名称"/>
	</div>
    <label for="metaSlug">分类缩略名</label>
	<div class="form-group">
			<input type="text" name="slug" id="metaSlug" class="form-control" value="<?php echo ($meta["slug"]); ?>" placeholder="分类名称"/>
	</div>
	<label for="metaDescription">描述</label>
	<div class="form-group">
			<textarea class="form-control" rows="6" id="metaDescription" name="description" placeholder="内容"><?php echo ($meta["description"]); ?></textarea>
	</div>
	
	<?php if($meta): ?><bottom type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-id="<?php echo ($meta["MID"]); ?>">删除</bottom><?php endif; ?><button type="submit" class="btn btn-default  pull-right">保存</button>
</form>
</div>
<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
  console.log("Start")
  var button = $(event.relatedTarget);
  var id = button.data('id');
  var modal = $(this)
  modal.find('.modal-body p').text("你确定删除<?php echo ($meta["title"]); ?>吗？");
  modal.find("#deleteBottom").attr("href","/index.php/Admin/Post/metaDelete/"+id);
})
</script>
		</div>
        
		<div class="col-md-4">
		    <?php if(!$adminLogin): ?><nav class="">
    <ul class="nav nav-pills nav-stacked">
  <li role="presentation"><a href="/index.php/Admin/Index">管理首页</a></li>
  <li role="presentation"><a href="/index.php/Admin/Index/setting">网站设置</a></li>
  <li role="presentation"><a href="/index.php/Admin/Post/edit">撰写文章</a></li>
  <li role="presentation"><a href="/index.php/Admin/Post/meta">分类管理</a></li>
  <li role="presentation"><a href="/index.php/Admin/Comment/index">评论管理</a></li>
  <li role="presentation"><a href="/index.php/Admin/Post/pageIndex">独立页面</a></li>
  <li role="presentation"><a href="/index.php/Admin/Index/changePassword">修改密码</a></li>
  <li role="presentation"><a href="/index.php/Admin/Index/exitAdmin">安全退出</a></li>
  <li role="presentation"><a href="/index.php">网站首页</a></li>
</ul>
</nav><?php endif; ?>
		</div>
	</div>
</div>

  </body>
</html>