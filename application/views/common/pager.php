<?php
/**
 * @name pager.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-5
 * Encoding UTF-8
 */
$this->widget('CLinkPager', array(
		'pages' => $pager,
		'header' => '',
		'cssFile' => false,
		'firstPageLabel' => '第一页',
		'lastPageLabel' => '最后一页',
		'prevPageLabel' => '上一页',
		'nextPageLabel' => '下一页',
		'internalPageCssClass' => 'page-button',
		'selectedPageCssClass' => 'current page-button',
		'previousPageCssClass' => 'previous page-button',
		'nextPageCssClass' => 'next page-button',
		'firstPageCssClass' => 'previous page-button',
		'lastPageCssClass' => 'next page-button')
);