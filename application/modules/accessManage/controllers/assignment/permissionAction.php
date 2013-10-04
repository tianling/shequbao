<?php
/**
 * @name operationAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-5
 * Encoding UTF-8
 */
class permissionAction extends CmsAction{
	public function run(){
		$roleId = $this->getQuery('role',null);
		if ( $roleId === null ){
			$this->redirect($this->request->urlReferrer);
		}
		$model = $this->app->getAuthManager()->getItemModel(AuthManager::OPERATION,false);
		if ( $model === null ){
			$this->redirect($this->request->urlReferrer);
		}
		$withOption = array(
				'with' => array(
						'AuthPermissions'
				)
		);
		
		$rolePermissions = $this->app->getAuthManager()->getCalculator()->findRolePermissions($roleId);
		
		$data = array();
		$levelOne = $model->findChildrenByLevel(1,$withOption);
		foreach ( $levelOne as $i => $level ){
			$data[$i]['parent'] = $level->AuthPermissions[0];
			$data[$i]['children'] = array();
			$levelTwo = $model->findChildrenByParent($level,$withOption);
			foreach ( $levelTwo as $j => $levelT ){
				$data[$i]['children'][$j]['parent'] = $levelT->AuthPermissions[0];
				$data[$i]['children'][$j]['children'] = array();
				$levelThree = $model->findChildrenByParent($levelT,$withOption);
				foreach ( $levelThree as $levelTh ){
					$data[$i]['children'][$j]['children'][] = $levelTh->AuthPermissions[0];
				}
			}
		}
		
		$this->registerTreePlugin();
		$this->pageTitle = '权限分配';
		$this->render('operation',array('list'=>$data,'rolePermissions'=>$rolePermissions));
	}
	
	public function registerTreePlugin(){
		$cs = $this->app->getClientScript();
		$url = $this->getController()->pluginUrl;
		$script = '$(function(){
	var options = {
			expandable: true,
	};
	$("#tree").treetable(options);
});';
		
		$cs->registerScriptFile($url.'treetable/javascripts/src/jquery.treetable.js',CClientScript::POS_END);
		$cs->registerScript('tree',$script,CClientScript::POS_END);
		$cs->registerCssFile($url.'treetable/stylesheets/jquery.treetable.css');
		$cs->registerCssFile($url.'treetable/stylesheets/jquery.treetable.theme.default.css');
	}
}