<?php

Router::connect('/page/*', array('plugin' => 'cms', 'controller' => 'cms_pages', 'action' => 'view'));
Router::connect('/index/*', array('plugin' => 'cms', 'controller' => 'cms_pages', 'action' => 'index'));