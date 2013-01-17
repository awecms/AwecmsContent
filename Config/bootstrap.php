<?php
App::uses('CakeEventManager', 'Event');
App::uses('CmsListener', 'Cms.Lib');
CakeEventManager::instance()->attach(new CmsListener());