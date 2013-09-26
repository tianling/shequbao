<?php
/**
 * @name TestController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-25
 * Encoding UTF-8
 */
class TestController extends CmsController{
	public function filters(){
		return array();
	}
	public function actionIndex(){
		$this->app->setComponent('db',array(
					'class' => 'system.db.CDbConnection',
					'autoConnect' => false,
					'connectionString' => 'mysql:host=localhost;dbname=area',
					'emulatePrepare' => true,
					'username' => 'lancelot',
					'password' => 'lancelot!410',
					'charset' => 'utf8',
					'tablePrefix' => 'xcms_'
		));
		$db = $this->app->db;
		$province = $db->createCommand()->from('province')->queryAll();
		foreach ( $province as $p => $pro ){
			$pArea = new Area();
			$pArea->attributes = array('area_name'=>$pro['province']);
			$pArea->save();
			$city = $db->createCommand()->from('city')->where('fatherID='.$pro['provinceID'])->queryAll();
			foreach ( $city as $c => $ci ){
				if ( strpos($ci['city'],'辖') !== false || strpos($ci['city'],'县') !== false ){//a
					if ( strpos($ci['city'],'辖') ){
						$zhixiaArea = new Area();
						$zhixiaArea->attributes = array(
								'area_name'=>$pro['province'],
								'fid' => $pArea->id
						);
						$zhixiaArea->save();
					}
					$qArea = $db->createCommand()->from('area_resource')->where('fatherID='.$ci['cityID'])->queryAll();
					foreach ( $qArea as $q => $qa ){
						$aArea = new Area();
						$aArea->attributes = array(
								'area_name' => $qa['area'],
								'fid' => $zhixiaArea->id
						);
						$aArea->save();
					}
				}else {//else a
					$cArea = new Area();
					$cArea->attributes = array(
							'area_name'=>$ci['city'],
							'fid' => $pArea->id
					);
					$cArea->save();
					
					$qArea = $db->createCommand()->from('area_resource')->where('fatherID='.$ci['cityID'])->queryAll();
					foreach ( $qArea as $q => $qa ){
						$aArea = new Area();
						$aArea->attributes = array(
								'area_name' => $qa['area'],
								'fid' => $cArea->id
						);
						$aArea->save();
					}
				}
			}
			set_time_limit(60);
		}
	}
}