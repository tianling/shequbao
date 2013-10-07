<?php
/**
 * @name SqbConfig.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-8-12
 * Encoding UTF-8
 */
class SqbConfig extends ConfigBase{
	
	public function init($owner){
		parent::init($owner);
		$this->debug = true;
		$this->traceLevel = 3;
	}
	
	public function merge(){
		return array(
				'modules' => array(
						'gii'=>array(
								'class'=>'system.gii.GiiModule',
								'password'=>'lancelot!410',
								'ipFilters'=>array('127.0.0.1','::1'),
						),
						'user' => array(
								'class' => 'application.modules.user.UserModule'
						),
						'sqbadmin' => array(
								'class' => 'application.modules.admin.AdminModule'
						),
						'ad' => array(
								'class' => 'application.modules.ad.AdModule'
						),
						'friends' => array(
								'class' => 'cms.modules.friends.FriendsModule',
								'userManagerId' => 'UserManager'
						),
						'area' => array(
								'class' => 'cms.modules.area.AreaModule'
						),
						'access' => array(
								'class' => 'cms.modules.accessControl.AccessControlModule'
						),
						'accessManage' => array(
								'class' => 'application.modules.accessManage.AccessManageModule'
						),
						'community'=>array(
								'class'=>'application.modules.community.CommunityModule'
						),
				),
				'preloadModels' => array(
						'area',
						'user',
						'friends',
						'access'
				),
				'import' => array(
						'application.modules.user.models.*'
				),
				'components' => array(
						'mailer' => array(
								'class' => 'cms.extensions.mailer.EMailer',
								'pathViews' => 'application.views.email',
								'pathLayouts' => 'application.views.email.layouts',
								'ccEmail'=>'',
								'Mailer' => 'smtp',
								'SMTPAuth'=>true,
								'Username'=>'574891711',
								'Password'=>'lancelot@410',
								'From'=>'574891711@qq.com',
								'FromName'=>'社区宝',
								'Host'=>'smtp.qq.com',
								'Port'=>'25',
								'CharSet'=>'UTF-8',
						),
						
						'cache' => array(
								'class' => 'CDbCache',
								'connectionID' => 'db',
								'cacheTableName' => 'xcms_yii_cache',
								'autoCreateCacheTable' => false
						),
						
						'chatManager' => array(
								'messagePusherId' => 'JPush'
						),
						
						'pusher' => array(
								'appKey' => '754d6e41a35fb03f778d53ae',
								'masterSecret' => 'cc2e44d8d49b0cc5f02126ab'
						),
						
						'UserManager' => array(
								'class' => 'application.modules.user.components.FrontUserManager'
						),
						
						'log'=>array(
								'class'=>'CLogRouter',
								'routes'=>array(
										array(
												'class'=>'CWebLogRoute',
												//'levels'=>'error, warning',
										),
								),
						),

						'image'=>array(
							'class'=>'ext.image.CImageComponent',
							'driver'=>'GD',
							'params'=>array('directory'=>'/opt/local/bin'),
						),
						
						'db' => array(
								'class' => 'system.db.CDbConnection',
								'autoConnect' => false,
								'connectionString' => 'mysql:host=121.199.54.87;dbname=shequbao'/*'mysql:host=localhost;dbname=shequbao'*/,
								'emulatePrepare' => true,
								'username' => 'sqb-sandbox',
								'password' => 'sqb-sandbox@aliyun',
								'charset' => 'utf8',
								'tablePrefix' => 'xcms_'
						),
						'db' => array(
								'class' => 'system.db.CDbConnection',
								'autoConnect' => false,
								'connectionString' => 'mysql:host=localhost;dbname=shequbao',
								'emulatePrepare' => true,
								'username' => 'sqb-sandbox',
								'password' => 'sqb-sandbox@aliyun',
								'charset' => 'utf8',
								'tablePrefix' => 'xcms_'
						),

						
						'urlManager'=>array(
								'urlFormat'=>'path',
								'urlSuffix' => '',
								'showScriptName' => false,
								'rules' => require dirname(__FILE__).'/RestApiRules.php',
								//'cacheID' => false
						),
						
				),
				'params' => array(
						'copyright' => 'Copyright &copy; 2012-2013 <a href="http://www.caixiao2.com">www.caixiao2.com</a>'
				),
		);
	}
}