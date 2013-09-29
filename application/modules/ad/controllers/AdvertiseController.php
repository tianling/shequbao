<?php
class AdvertiseController extends CmsController
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','update','delete','upload','GetDistance'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin',),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		$criteria = new CDbCriteria;
		$criteria ->select = 'id,advertiser_id,title';
		$criteria ->order = 'id DESC';
		$advertiseData = Advertise::model()->findAll($criteria);
		$this->render('index',array('advertiseData'=>$advertiseData));

	}

	public function actionCreate()
	{
		$model = new Advertise;
		if(isset($_POST['Advertise']) && isset($_POST['submit'])){
			$model->attributes = $_POST['Advertise'];
			if($model->save())
			{
				if(isset($_SESSION['pid']) && is_numeric($_SESSION['pid'])){
					$pid = $_SESSION['pid'];
					$picModel = AdvertisePic::model()->findByPk($pid);
					$picModel->ad_id = $model->id;
					$picModel->save();
						
				}
				$this->redirect(Yii::app()->createUrl('ad/advertise/create'));
			}else{
			var_dump($model->getErrors());
			}
		}
		$this->render('create',array('model'=>$model));

	}

	public function actionUpdate($id)
	{
		if(!empty($id) && is_numeric($id)){
			$model=$this->loadModel($id);
			if(isset($_POST['Advertise'])){
				$model->attributes=$_POST['Advertise'];
				if($model->save())
					echo "ok";
			}
			$this->render('update',array('model'=>$model));
			
			
		}
	}
	
	public function loadModel($id)
	{
		$model=Advertise::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function init(){
		//parent::init();

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
					//echo $saveUrl;
					//echo " ".$saveThumb;
					$thumbUrl = str_replace(dirname(Yii::app()->basePath),"",$thumbUrl);
					//echo "</br>".$thumbUrl;
					//保存信息到数据库
					$model = new AdvertisePic;
					$model->ad_id = 3;
					$model->url = $picUrl;
					$model->description = $picName;
					$model->thumb_url = $thumbUrl;
					//$model->picAddTime = date('Y-m-d H:i:s');
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


	public 	function actionGetDistance($lat1, $lng1, $lat2, $lng2)  
	{  
	    $EARTH_RADIUS = 6378.137;  
	    $radLat1 = rad($lat1);  
	    //echo $radLat1;  
	    $radLat2 = rad($lat2);  
	    $a = $radLat1 - $radLat2;  
	    $b = rad($lng1) - rad($lng2);  
	    $s = 2 * asin(sqrt(pow(sin($a/2),2) +  
	    cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)));  
	    $s = $s *$EARTH_RADIUS;  
	    $s = round($s * 10000) / 10000;  
	    return $s;  
	}  
}
?>