<?php
$config = array(
	'AwecmsSeo' => array(
		'sitemap' => array(
			'models' => array(
				'AwecmsContent.Page' => array('controller' => 'cms_pages')
			)
		),
		'meta' => array(
			'actions' => array(
				'cms_pages.view' => array('model' => 'Page')
			)
		)
	)
);