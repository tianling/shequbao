<?php
/**
 * @name viewChat.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-7
 * Encoding UTF-8
 */
class viewChatAction extends CmsAction{
	public function run(){
		$query = $this->getQuery('ViewChatForm',null);
		$formModel = new ViewChatForm();
		$pager = null;
		$route = null;
		$viewData = array();
		
		if ( $query !== null ){
			$formModel->attributes = $query;
			if ( $formModel->validate() ){
					$data = $this->loadData($formModel);
					if ( $data !== array() ){
						$pager = $data['pager'];
						$viewData = $data['data'];
						$route = $data['route'];
					}
			}
		}
		
		$form = $this->getForm($formModel);
		$form->method = 'get';
		$this->pageTitle = '查看聊天';
		$this->render('viewChat',array('form'=>$form,'data'=>$viewData,'pager'=>$pager,'route'=>$route));
	}
	
	/**
	 * 
	 * @param ViewChatForm $formModel
	 */
	public function loadData($formModel){
		$criteria = new CDbCriteria();
		switch ( $formModel->searchType ){
			case 'user':
			default:
				$model = SqbUser::model();
				$criteria->with = array(
						'baseUser' => array(
								'alias' => 'base',
								'select' => 'id,nickname'
						)
				);
				$criteria->addSearchCondition('base.nickname',$formModel->keyword);
				break;
			case 'group':
				$model = Groups::model();
				$criteria->addSearchCondition('group_name',$formModel->keyword);
				break;
			case 'room':
				$model = ChatRoom::model();
				$criteria->addSearchCondition('room_name',$formModel->keyword);
				break;
		}
		
		$count = $model->count($criteria);
		if ( $count === 0 ){
			return array();
		}
		$pager = new CPagination($count);
		$pager->pageSize = 50;
		$pager->applyLimit($criteria);
		$data = $model->findAll($criteria);
		$returnData = array();
		
		switch ( $formModel->searchType ){
			case 'user':
			default:
				foreach ( $data as $d ){
					$returnData[] = array(
							'id' => $d->id,
							'name' => $d->nickname
					);
				}
				$route = 'chat/user';
				break;
			case 'group':
				foreach ( $data as $d ){
					$returnData[] = array(
							'id' => $d->id,
							'name' => $d->group_name
					);
				}
				$route = 'chat/group';
				break;
			case 'room':
				foreach ( $data as $d ){
					$returnData[] = array(
							'id' => $d->id,
							'name' => $d->room_name
					);
				}
				$route = 'chat/room';
				break;
		}
		
		return array(
				'pager' => $pager,
				'data' => &$returnData,
				'route' => $route
		);
	}
	
	public function getForm($model){
		$config = array(
				'elements' => array(
						'searchType' => array(
								'type' => 'dropdownlist',
								'label' => '选择搜索对象',
								'items' => array(
										'user' => '搜索用户聊天记录',
										'group' => '搜索群聊天记录',
										'room' => '搜索小区聊天记录'
								),
								'class' => 'form-input-dropdownlist'
						),
						'keyword' => array(
								'type' => 'text',
								'label' => '搜索对象名称',
								'class' => 'form-input-text',
						)
				),
				'buttons' => array(
						'search' => array(
								'type' => 'submit',
								'label' => '搜索',
								'class' => 'form-button'
						)
				)
		);
		
		return new CForm($config,$model);
	}
}