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
	<?php echo $content?>
	
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