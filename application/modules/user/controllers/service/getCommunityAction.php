<?php
/**
 * @name getCommunityAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-28
 * Encoding UTF-8
 */
class getCommunityAction extends CmsAction{
	public function run($resourceId){
		$location = $this->getQuery('location',null);
		$type = $this->getQuery('type',null);
		if ( $type === null ){
			$this->response(301);
		}
		
		$type = intval($type);
		$response = array();
		$communities = array();
		if ( $type === 1 ){
			if ( $location === null ){
				$this->response(301);
			}
			$communities = Community::model()->findAll('location=:location',array(':location'=>$location));
		}elseif ( $type === 2 ){
			$uid = $this->app->getUser()->getId();
			$communities = CommunityUser::model()->with('communities')->findAll('user_id=:uid',array(':uid'=>$uid));
		}
		
		foreach ( $communities as $community ){
			$response[] = array(
					'id' => $community->getPrimaryKey(),
					'name' => $community->getAttribute('community_name')
			);
		}
		
		$this->response(300,'',$response);
	}
}