<?php
/**
 * @name SiteController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-8-9
 * Encoding UTF-8
 */
class SiteController extends CmsController{
	public function filters(){
		return array();
	}
	
	public function actionIndex(){
		
	}
	
	public function area(){
		ini_set('max_execution_time',300);
		$dbLocal = Yii::app()->getComponent('dbLocal');
		
		$countrys = $dbLocal->createCommand("select * from location WHERE location2='00'")->query();
		
 		foreach ( $countrys as $country ){
			$CountryAttributes = $country;
			$CountryModel = null;
			$CountryModel = new Area();
			$CountryModel->attributes = array(
					'fid' => 0,
					'country' => $CountryAttributes['country'],
					'cn_name' => $CountryAttributes['cn'],
					'cn_district' => $CountryAttributes['cn_district'],
					'big5_name' => $CountryAttributes['big5'],
					'big5_district' => $CountryAttributes['big5_district'],
					'en_name' => $CountryAttributes['en_name'],
					'en_district' => $CountryAttributes['en_district'],
					'city_tier' => $CountryAttributes['city_tier']
			);
			$CountryModel->save();
			$provinces = $dbLocal->createCommand("SELECT * FROM location WHERE location3='000' AND location1='{$CountryAttributes['location1']}' AND ID!={$CountryAttributes['ID']}")->query();
			foreach ( $provinces as $province ){
				$provinceAttributes = $province;
				$provinceModel = new Area();
				$provinceModel->attributes = array(
						'fid' => $CountryModel->getPrimaryKey(),
						'country' => $provinceAttributes['country'],
						'cn_name' => $provinceAttributes['cn'],
						'cn_district' => $provinceAttributes['cn_district'],
						'big5_name' => $provinceAttributes['big5'],
						'big5_district' => $provinceAttributes['big5_district'],
						'en_name' => $provinceAttributes['en_name'],
						'en_district' => $provinceAttributes['en_district'],
						'city_tier' => $provinceAttributes['city_tier']
				);
				$provinceModel->save();
				$cities = $dbLocal->createCommand("SELECT * FROM location WHERE location1='{$CountryAttributes['location1']}' AND location2='{$provinceAttributes['location2']}' AND ID!={$provinceAttributes['ID']}")->query();
				foreach ( $cities as $city ){
					$cityAttributes = $city;
					$cityModel = new Area();
					$cityModel->attributes = array(
						'fid' => $provinceModel->getPrimaryKey(),
						'country' => $cityAttributes['country'],
						'cn_name' => $cityAttributes['cn_city'],
						'cn_district' => $cityAttributes['cn_district'],
						'big5_name' => $cityAttributes['big5_city'],
						'big5_district' => $cityAttributes['big5_district'],
						'en_name' => $cityAttributes['en_city'],
						'en_district' => $cityAttributes['en_district'],
						'city_tier' => $cityAttributes['city_tier']
					);
					$cityModel->save();
					$cityModel = null;
				}
				
				$provinceModel = null;
			}
			
			$CountryModel = null;
			
 		}
	}
}