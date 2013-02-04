<?php
$this->extend('PieceOCake./Widgets/edit');
echo $this->Form->input('Widget.data.type');
if ($this->Session->read('Auth.User.is_admin')) :
	echo $this->Form->input('Widget.data.element');
endif;