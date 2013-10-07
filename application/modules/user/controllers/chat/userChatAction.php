<?php
/**
 * @name userChatAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-7
 * Encoding UTF-8
 */
class userChatAction extends CmsAction{
	public function run(){
		$chatData = array();
		$user1 = $this->getQuery('user1');
		$user2 = $this->getQuery('user2');
		$searchSubmit = $this->getQuery('searchSubmit',null);
		
		if ( $searchSubmit !== null ){
			$criteria = new CDbCriteria();
			$criteria->with = array(
					'baseUser' => array(
							'alias' => 'base',
							'select' => 'nickname'
					)
			);
			
			if ( !empty($user1) ){
				$criteria->addSearchCondition('base.nickname',$user1);
				$leftUsers = SqbUser::model()->findAll($criteria);
			}
		}
	}
}