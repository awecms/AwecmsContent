<?php

Router::connect('/page/*', array('plugin' => 'awecms_content', 'controller' => 'cms_pages', 'action' => 'view'));
Router::connect('/index/*', array('plugin' => 'awecms_content', 'controller' => 'cms_pages', 'action' => 'index'));