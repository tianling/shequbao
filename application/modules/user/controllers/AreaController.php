<?php
/**
 * this calss is to create Area
 * @author jstong
 *
 */
class AreaController extends CmsController
{

	public function actionCreate(){
		$modle = new Area();
		$data = array('fid'=>1,'area_name'=>'test');
		$modle->attributes = $data;
		if($modle->save()){
			echo '新增地址成功';
		}else{
			echo '增加失败';
		}
	}

}