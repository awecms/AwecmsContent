<?php
$this->extend('PieceOCake./Widgets/edit');
echo $this->Form->input('Widget.data.page_id');
echo $this->Form->input('Widget.data.truncate');
echo $this->Form->input('Widget.data.ellipsis');
echo $this->Form->input('Widget.data.read_more_text');
echo $this->Form->input('Widget.data.exact', array('type' => 'checkbox'));
echo $this->Form->input('Widget.data.use_page_title', array('type' => 'checkbox'));
if ($this->Session->read('Auth.User.is_admin')) :
	echo $this->Form->input('Widget.data.html', array('type' => 'checkbox'));
	echo $this->Form->input('Widget.data.escape', array('type' => 'checkbox'));
	echo $this->Form->input('Widget.data.element');
endif;