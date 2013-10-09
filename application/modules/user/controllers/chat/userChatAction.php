<?php
/**
 * @name userChatAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-8
 * Encoding UTF-8
 */
class userChatAction extends CmsAction{
	public function run(){
		$mUid = $this->getQuery('id',null);
		if ( $mUid === null ){
			$this->redirect($this->createUrl('chat/viewChat'));
		}
		$criteria = new CDbCriteria();
		$pager = null;
		$data = array();
		$sUid = $this->getQuery('sUid',null);
		if ( $sUid !== null ){//查看详细信息
			$user = UserModel::model()->findByPk($mUid,array('select'=>'nickname'));
			$sUser = UserModel::model()->findByPk($sUid,array('select'=>'nickname'));
			if ( $user === null || $sUser === null ){
				$this->redirect($this->createUrl('chat/viewChat'));
			}
			
			$userName = $user->nickname;
			$sUserName = $sUser->nickname;
			$model = UserMessage::model();
			$criteria->addCondition('(sender=:u AND receiver=:r) OR (sender=:r AND receiver=:u)');
			$criteria->params = array(
					':u' => $mUid,
					':r' => $sUid
			);
			
			$count = $model->count($criteria);
			if ( $count !== 0 ){
				$criteria->order = 'send_time DESC';
				$pager = new CPagination($count);
				$pager->pageSize = 50;
				$pager->applyLimit($criteria);
				
				$data = $model->findAll($criteria);
			}
			
			$this->pageTitle = '聊天记录';
			$this->getController()->addToSubNav('返回','chat/user','返回',array('id'=>$mUid));
			$this->render('viewUserChat',array('data'=>$data,'mUid'=>$mUid,'userName'=>$userName,'sUserName'=>$sUserName,'pager'=>$pager));
		}else {//查看用户列表
			$model = UserInterest::model();
			
			$criteria->addCondition('follower=:uid AND status=1');
			
			$keyword = $this->getQuery('keyword',null);
			if ( !empty($keyword) ){
				$criteria->addSearchCondition('followed.nickname',$keyword);
			}
			$criteria->with = array(
					'followed' => array(
							'alias' => 'followed'
					)
			);
			$criteria->params[':uid'] = $mUid;
			$count = $model->count($criteria);
			if ( $count !== 0 ){
				$pager = new CPagination($count);
				$pager->pageSize = 35;
				$pager->applyLimit($criteria);
				
				$data = $model->findAll($criteria);
			}
			
			$this->pageTitle = '选择好友';
			$this->getController()->addToSubNav('查看其他类型聊天记录','chat/viewChat','查看其他类型聊天记录');
			$this->render('viewFriendsList',array('mUid'=>$mUid,'keyword'=>$keyword,'data'=>$data,'pager'=>$pager));
		}
	}
}