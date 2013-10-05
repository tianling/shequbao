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
			<label for="nickname">昵称*</label>
			<input value="<?php echo $model->nickname?>" type="text" id="nickname" name="SqbUser[nickname]" class="form-input-text" />
		</div>
		<div>
			<label for="mobile">手机号*</label>
			<input value="<?php echo $model->mobile?>" type="text" id="mobile" name="SqbUser[mobile]" class="form-input-text" />
		</div>
		<div>
			<label for="email">邮箱*</label>
			<input value="<?php echo $model->email?>" type="text" id="email" name="SqbUser[email]" class="form-input-text" />
		</div>
		<div>
			<label for=password>密码*</label>
			<input value="<?php echo $model->password?>" type="password" id="password" name="SqbUser[password]" class="form-input-text" />
		</div>
		<div>
			<input type="submit" name="SqbUser[submit]" class="form-button form-button-submit" value="确定" />
		</div>
	</form>
</div>