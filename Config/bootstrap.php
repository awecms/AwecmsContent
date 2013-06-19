<?php

CakePlugin::load('FineUploader', array('routes' => true));

App::uses('CakeEventManager', 'Event');
App::uses('AwecmsContentListener', 'AwecmsContent.Lib');
CakeEventManager::instance()->attach(new AwecmsContentListener());