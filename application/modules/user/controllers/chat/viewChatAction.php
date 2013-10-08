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
		$userId = $this->getQuery('id');
		$searchUser = $this->getQuery('searchUser');
		$searchGroup = $this->getQuery('searchGroup');
		$searchRoom = $this->getQuery('searchRoom');
		$searchSubmit = $this->getQuery('searchSubmit',null);
		$data = array(
				'users' => array(),
				'groups' => array(),
				'rooms' => array(),
		);
		
		if ( $searchSubmit !== null ){
			$criteria = new CDbCriteria();
			$criteria->with = array(
					'baseUser' => array(
		 					'alias' => 'base',
							'select' => 'nickname'
					)
			);
		}
	}
}