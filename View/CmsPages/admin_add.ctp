<?php
	$this->assign('title', __d('awecms_content', 'Pages'));
	$this->assign('class', 'form');
?>
<?php echo $this->Form->create('Page', array('layout' => 'horizontal'));?>
<fieldset>
	<legend><?php echo __d('awecms_content', 'New Page'); ?></legend>
	<?php
		echo $this->Form->input('title', array('class' => 'input-xxlarge'));
		echo $this->Form->input('slug');
		echo $this->Form->input('type');
		echo $this->Form->input('is_active');
		echo $this->Editor->input('Page.content', array('class' => 'input-block-level'));
		echo $this->Form->input('preview', array('class' => 'input-block-level'));
		echo $this->FineUploader->image('featured_image');
		echo $this->FineUploader->image('preview_image');
		echo $this->Form->actions();
	?>
</fieldset>
<?php echo $this->Form->end();?>