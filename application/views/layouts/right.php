<?php
/**
 * @name right.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-2
 * Encoding UTF-8
 */
$cssUrl = $this->request->baseUrl.'/css/';
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		
		<link href="<?php echo $cssUrl?>skin.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $cssUrl?>common.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $cssUrl?>adminList.css" rel="stylesheet" type="text/css" />
		<style type="text/css">
		<!--
		body {
			margin-left: 0px;
			margin-top: 0px;
			margin-right: 0px;
			margin-bottom: 0px;
			background-color: #EEF2FB;
		}
		-->
		</style>
	</head>
	
	<body>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="17" valign="top" background="<?php echo $this->imgUrl;?>mail_leftbg.gif"><img
					src="<?php echo $this->imgUrl;?>left-top-right.gif" width="17" height="29" /></td>
				<td valign="top" background="<?php echo $this->imgUrl;?>content-bg.gif"><table
						width="100%" height="31" border="0" cellpadding="0" cellspacing="0"
						class="left_topbg" id="table2">
						<tr>
							<td height="31"><div class="titlebt"><?php echo CHtml::encode($this->pageTitle); ?></div></td>
						</tr>
					</table></td>
				<td width="16" valign="top" background="<?php echo $this->imgUrl;?>mail_rightbg.gif"><img
					src="<?php echo $this->imgUrl;?>nav-right-bg.gif" width="16" height="29" /></td>
			</tr>
			
			<tr>
				<td valign="middle" background="<?php echo $this->imgUrl;?>mail_leftbg.gif">&nbsp;</td>
				<td valign="top" bgcolor="#F7F8F9">
					<div class="subnav">
						<div class="content-menu blue line-x"></div>
					</div>
					<div class="Info">
						<?php echo $content?>
					</div>
				</td>
				<td background="<?php echo $this->imgUrl;?>mail_rightbg.gif">&nbsp;</td>
			</tr>
			
			<tr>
				<td valign="bottom" background="<?php echo $this->imgUrl;?>mail_leftbg.gif"><img
					src="<?php echo $this->imgUrl;?>buttom_left2.gif" width="17" height="17" /></td>
				<td background="<?php echo $this->imgUrl;?>buttom_bgs.gif"><img
					src="<?php echo $this->imgUrl;?>buttom_bgs.gif" width="17" height="17"></td>
				<td valign="bottom" background="<?php echo $this->imgUrl;?>mail_rightbg.gif"><img
					src="<?php echo $this->imgUrl;?>buttom_right2.gif" width="16" height="17" /></td>
			</tr>
		</table>
		
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="center">
					<span class="left_txt">
						<?php echo Yii::app()->params['copyright']?>
					</span>
				</td>
			</tr>
		</table>
	</body>
</html>