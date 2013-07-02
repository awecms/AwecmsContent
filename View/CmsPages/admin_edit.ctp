<?php
	$this->assign('title', __d('awecms_content', 'Pages'));
	$this->assign('class', 'form');
	$this->Menu->match(array('action' => 'index'));
	
	$this->Menu->addItem(
		__d('awecms', 'Delete'),
		array('action' => 'delete', $this->Form->value('Page.id')),
		array(
			'group' => 'actions',
			'icon' => 'remove',
			'confirm' => __d('awecms', 'Are you sure you want to delete %s?', $this->Form->value('Page.name'))
		)
	);
?>
<?php echo $this->Form->create('Page', array('class' => 'form-horizontal'));?>
<fieldset>
	<legend><?php echo __d('awecms_content', 'Edit Page'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('slug');
		echo $this->Form->input('type');
		echo $this->Form->input('is_active');
		echo $this->Editor->input('Page.content');
		echo $this->Form->input('preview');
		echo $this->FileManager->image('featured_image');
		echo $this->FileManager->image('preview_image');
	?>
</fieldset>
<?php echo $this->Form->end();?>
