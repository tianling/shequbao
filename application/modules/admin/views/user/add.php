<?php
/**
 * @name add.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-3
 * Encoding UTF-8
 */
?>

<div class="form-list">
	<div class="form-title">添加管理员</div>
	<form action="<?php echo $action?>" method="post" >
		<div class="errorMessage">
			<?php foreach ( $model->getErrors() as $error ):?>
			<span><?php echo $error[0]?></span>
			<?php endforeach;?>
		</div>
		<div>
			<label for="Administrators-surname">姓氏</label>
			<input value="<?php echo $model->surname?>" type="text" id="Administrators-surname" name="Administrators[surname]" class="form-input-text" />
		</div>
		<div>
			<label for="Administrators-name">名字</label>
			<input value="<?php echo $model->name?>" type="text" id="Administrators-name" name="Administrators[name]" class="form-input-text" />
		</div>
		<div>
			<label for="Administrators-nickname">昵称*</label>
			<input value="<?php echo $model->nickname?>" type="text" id="Administrators-nickname" name="Administrators[nickname]" class="form-input-text" />
		</div>
		<div>
			<label for="Administrators-password">密码*</label>
			<input type="password" id="Administrators-password" name="Administrators[password]" class="form-input-text" />
		</div>
		<div>
			<label for="Administrators-phone">手机号*</label>
			<input value="<?php echo $model->phone?>" type="text" id="Administrators-phone" name="Administrators[phone]" class="form-input-text" />
		</div>
		<div>
			<label for="Administrators-email">邮箱*</label>
			<input value="<?php echo $model->email?>" type="text" id="Administrators-email" name="Administrators[email]" class="form-input-text" />
		</div>
		<div>
			<input type="submit" name="Administrators[submit]" class="form-button form-button-submit" value="确定" />
		</div>
	</form>
</div>