<?php
/**
 * @name index.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-8-6
 * Encoding UTF-8
 */
require dirname(__FILE__).'/../XCms1.0/cms.php';
require dirname(__FILE__).'/application/config/SqbConfig.php';
$environment = new Environment(new SqbConfig());
$environment->basePath = dirname(__FILE__).DS.'application'.DS;
$environment->run();