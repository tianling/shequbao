<?php
class AdvertiseController extends SqbController
{

	public function actionIndex()
	{	
		$id = Yii::app()->user->id;
		$criteria = new CDbCriteria;
		$criteria ->select = 'id,advertiser_id,title,cpc,priority';
		$criteria ->condition = 'advertiser_id = '.$id.'';
		$criteria ->order = 'id DESC';
		$count=Advertise::model()->count($criteria);
		$page=new CPagination($count);
		$page->pageSize=16;
		$page->applyLimit($criteria);
		$advertiseData = Advertise::model()->findAll($criteria);
		
		$this->addToSubNav('广告发布','advertise/create');
		$this->pageTitle = '广告管理';
		$this->render('index',array('advertiseData'=>$advertiseData,'pages'=>$page));

	}

	public function actionCreate()
	{
		
		$model = new Advertise;
		if(isset($_POST['Advertise']) && isset($_POST['submit'])){
			$model->attributes = $_POST['Advertise'];
			$model->advertiser_id = Yii::app()->user->id;

			if($model->save())
			{
				$advertiserAds = Advertiser::model()->with('baseUser')->findByPk($model->advertiser_id);

				if(!empty($advertiserAds)){
					$ads_old = $advertiserAds->ads;
					$advertiserAds->ads = $ads_old +1;
					$advertiserAds->save();
				}

				if(isset($_SESSION['pid']) && is_numeric($_SESSION['pid'])){
					$pid = $_SESSION['pid'];
					$picModel = AdvertisePic::model()->findByPk($pid);
					$picModel->ad_id = $model->id;
					$_SESSION['pid'] = null;
					$picModel->save();		
				}

				$this->redirect(Yii::app()->createUrl('ad/advertise/index'));
			}else{
				$this->redirect(Yii::app()->createUrl('site/index'));
			}
		}

		$this->pageTitle = '发布广告';
		$this->render('create',array('model'=>$model));

	}

	public function actionUpdate($id)
	{
		if(!empty($id) && is_numeric($id)){
			$model=$this->loadModel($id);
			if(!empty($model)){
				$adId = $model->id;
				$adPicModel = AdvertisePic::model()->findAll('ad_id=:id',array(':id'=>$id));
				if(!empty($adPicModel)){
					$ad_thumb = $adPicModel[0]['thumb_url'];	
				}else
					$ad_thumb = null;
			}
			if(isset($_POST['Advertise'])){
				$model->attributes=$_POST['Advertise'];
				if(isset($_SESSION['pid']) && is_numeric($_SESSION['pid'])){
					$pid = $_SESSION['pid'];
					$picModel = AdvertisePic::model()->findByPk($pid);
					$picModel->ad_id = $model->id;
					$_SESSION['pid'] = null;
					$old_id = $model->id;
					$old_data = AdvertisePic::model()->findAll('ad_id =:id',array(':id'=>$old_id));

					if(!empty($old_data)){
						$cleanOldData = AdvertisePic::model()->deleteAll('ad_id=:id',array('id'=>$old_id));
						if($cleanOldData>0){
							$picModel->save();
						}
					}else{
						$picModel->save();
					}
							
				}
				if($model->save())
					$this->redirect(Yii::app()->createUrl('ad/advertise/index'));
			}

			$this->pageTitle = '广告修改';
			$this->render('update',array('model'=>$model,'adPic'=>$ad_thumb,));
			
			
		}else
			$this->redirect(Yii::app()->createUrl('ad/advertise/index'));
	}

	public function actionDelete($id){
		if(!empty($id) && is_numeric($id)){
			$adModel = Advertise::model()->findByPk($id);
			if(!empty($adModel)){
				$advertiserAds = Advertiser::model()->with('baseUser')->findByPk($adModel->advertiser_id);
				if(!empty($advertiserAds)){
					$ads_old = $advertiserAds->ads;
					$advertiserAds->ads = $ads_old -1;
					if($advertiserAds->save()){
						$adModel->delete();
						$this->redirect(Yii::app()->createUrl('ad/advertise/index'));
					}else{
						$this->redirect(Yii::app()->createUrl('site/index'));
					}
					
				}
				

			}
		}
		$this->redirect(Yii::app()->createUrl('ad/advertise/index'));
	}

	
	public function loadModel($id)
	{
		$model=Advertise::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function init(){
		parent::init();

		//$phpsessid = $this->getPost();
		if(isset($_POST['PHPSESSID']))
			session_id($_POST['PHPSESSID']);

	}

	public function actionUpload()
		{
			$typeArray = array('jpg','png','gif','bmp','jpeg');
			$maxSize = 1024*1024*2; //最大文件大小约为2MB
			if(isset($_FILES['Filedata'])){
				$fileInfo = CUploadedFile::getInstanceByName('Filedata');
				$picName = $fileInfo->name;
				//die($picName);
				$picType = Tool::getFileType($picName); //调用自定义公共函数类的获取文件类型函数
				if(in_array($picType,$typeArray)){
					$upError = '文件类型不对';
				}
				if($fileInfo->size>$maxSize){
					$upError = '文件超过2MB！';
				}
				$thumbDir = dirname(Yii::app()->basePath)."/upload/ad_pic/thumbs/";
				$uploadDir = dirname(Yii::app()->basePath)."/upload/ad_pic/pics/";
				$dateDir = date('Ym')."/";
				$uploadDir = $uploadDir.$dateDir;
				$thumbDir = $thumbDir.$dateDir;
				if(!is_dir($uploadDir)){
						mkdir($uploadDir,0077,true);
				}
				if(!is_dir($thumbDir)){
					mkdir($thumbDir,0077,true);
				}
				$randName = Tool::getRandName();//获取一个随机名
				$newName = "ad".$randName.".".$picType;//对文件进行重命名
				$saveUrl = $uploadDir.$newName;
				$picUrl = "/upload/ad_pic/pics/".$dateDir.$newName;
				$isUp = $fileInfo->saveAs($saveUrl);//保存上传文件
				if($isUp){
					$thumbName = "thumbs".$randName.".".$picType;
					$saveThumb = $thumbDir.$thumbName;
					$thumbUrl = Tool::getThumb($saveUrl,300,300,$saveThumb);//制作缩略图并放回缩略图存储路径
					$thumbUrl = str_replace(dirname(Yii::app()->basePath),"",$thumbUrl);
					//保存信息到数据库
					$model = new AdvertisePic;
					$model->url = $picUrl;
					$model->description = $picName;
					$model->thumb_url = $thumbUrl;
					$model->save();
					$id = $model->attributes['id'];
					$_SESSION['pid'] = $id;
					$backData = array(
						'pid'=>$id,
						'thumb'=>Yii::app()->baseUrl.$thumbUrl,
						);
					// 返回json数据给swfupload上传插件
					echo  json_encode($backData);
				}
			}
		}


}
?>