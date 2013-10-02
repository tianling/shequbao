<?php
/**
 * @name menu.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-16
 * Encoding UTF-8
 */
$cssUrl = $this->request->baseUrl.'/css/';
$jsUrl = $this->request->baseUrl.'/js/';
$imgUrl = $this->request->baseUrl.'/images/';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>管理菜单</title>
	
	<script src="<?php echo $jsUrl?>prototype.lite.js" type="text/javascript"></script>
	<script src="<?php echo $jsUrl?>moo.fx.js" type="text/javascript"></script>
	<script src="<?php echo $jsUrl?>moo.fx.pack.js" type="text/javascript"></script>
	<link href="<?php echo $cssUrl?>menu.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" height="280" border="0" cellpadding="0" cellspacing="0" bgcolor="#EEF2FB">
  <tr>
    <td width="182" valign="top"><div id="container">
      <h1 class="type"><a href="javascript:void(0)">网站常规管理</a></h1>
      <div class="content">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="<?php echo $imgUrl;?>menu_topline.gif" width="182" height="5" /></td>
          </tr>
        </table>
        <ul class="submenu">
          <li><a href="http://www.865171.cn" target="main">基本设置</a></li>
          <li><a href="http://www.865171.cn" target="main">邮件设置</a></li>
          <li><a href="http://www.865171.cn" target="main">广告设置</a></li>
          <li><a href="http://www.865171.cn" target="main">114增加</a></li>
          <li><a href="http://www.865171.cn" target="main">114管理</a></li>
          <li><a href="http://www.865171.cn" target="main">联系方式</a></li>
          <li><a href="http://www.865171.cn" target="main">汇款方式</a></li>
          <li><a href="http://www.865171.cn" target="main">增加链接</a></li>
          <li><a href="http://www.865171.cn" target="main">管理链接</a></li>
        </ul>
      </div>
      <h1 class="type"><a href="javascript:void(0)">栏目分类管理</a></h1>
      <div class="content">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="<?php echo $imgUrl;?>menu_topline.gif" width="182" height="5" /></td>
          </tr>
        </table>
        <ul class="submenu">
          <li><a href="http://www.865171.cn" target="main">信息分类</a></li>
          <li><a href="http://www.865171.cn" target="main">信息类型</a></li>
          <li><a href="http://www.865171.cn" target="main">资讯分类</a></li>
          <li><a href="http://www.865171.cn" target="main">地区设置</a></li>
          <li><a target="main" href="http://www.865171.cn">市场联盟</a></li>
          <li><a href="http://www.865171.cn" target="main">商家类型</a></li>
          <li><a href="http://www.865171.cn" target="main">商家星级</a></li>
          <li><a href="http://www.865171.cn" target="main">商品分类</a></li>
          <li><a href="http://www.865171.cn" target="main">商品类型</a></li>
        </ul>
      </div>
      <h1 class="type"><a href="javascript:void(0)">栏目内容管理</a></h1>
      <div class="content">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="<?php echo $imgUrl;?>menu_topline.gif" width="182" height="5" /></td>
          </tr>
        </table>
        <ul class="submenu">
		  <li><a href="http://www.865171.cn" target="main">信息管理</a></li>
          <li><a href="http://www.865171.cn" target="main">张贴管理</a></li>
          <li><a href="http://www.865171.cn" target="main">增加商家</a></li>
          <li><a href="http://www.865171.cn" target="main">管理商家</a></li>
          <li><a href="http://www.865171.cn" target="main">发布资讯</a></li>
          <li><a href="http://www.865171.cn" target="main">资讯管理</a></li>
          <li><a href="http://www.865171.cn" target="main">市场联盟</a></li>
          <li><a href="http://www.865171.cn" target="main">名片管理</a></li>
          <li><a href="http://www.865171.cn" target="main">商城管理</a></li>
          <li><a href="http://www.865171.cn" target="main">商品管理</a></li>
          <li><a href="http://www.865171.cn" target="main">商城留言</a></li>
          <li><a href="http://www.865171.cn" target="main">商城公告</a></li>
        </ul>
      </div>
      <h1 class="type"><a href="javascript:void(0)">注册用户管理</a></h1>
      <div class="content">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="<?php echo $imgUrl;?>menu_topline.gif" width="182" height="5" /></td>
          </tr>
        </table>
        <ul class="submenu">
          <li><a href="http://www.865171.cn" target="main">会员管理</a></li>
          <li><a href="http://www.865171.cn" target="main">留言管理</a></li>
          <li><a href="http://www.865171.cn" target="main">回复管理</a></li>
          <li><a href="http://www.865171.cn" target="main">订单管理</a></li>
          <li><a href="http://www.865171.cn" target="main">举报管理</a></li>
          <li><a href="http://www.865171.cn" target="main">评论管理</a></li>
        </ul>
      </div>
    </div>
        <h1 class="type"><a href="javascript:void(0)">其它参数管理</a></h1>
      <div class="content">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><img src="<?php echo $imgUrl;?>menu_topline.gif" width="182" height="5" /></td>
            </tr>
          </table>
        <ul class="submenu">
            <li><a href="http://www.865171.cn" target="main">管理设置</a></li>
          <li><a href="http://www.865171.cn" target="main">主机状态</a></li>
          <li><a href="http://www.865171.cn" target="main">攻击状态</a></li>
          <li><a href="http://www.865171.cn" target="main">登陆记录</a></li>
          <li><a href="http://www.865171.cn" target="main">运行状态</a></li>
        </ul>
      </div>
      </div>
        <script type="text/javascript">
		var contents = document.getElementsByClassName('content');
		var toggles = document.getElementsByClassName('type');
	
		var myAccordion = new fx.Accordion(
			toggles, contents, {opacity: true, duration: 400}
		);
		myAccordion.showThisHideOpen(contents[0]);
	</script>
        </td>
  </tr>
</table>
</body>
</html>
