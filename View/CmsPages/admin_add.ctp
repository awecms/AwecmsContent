<div class="pages form">
<?php echo $this->Form->create('Page');?>
	<fieldset>
		<legend><?php echo __('Add Page'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('type');
		echo $this->Form->input('is_active');
		echo $this->Editor->input('Page.content');
		echo $this->Form->input('preview');
		echo $this->FineUploader->image('featured_image');
		echo $this->FineUploader->image('preview_image');
		echo $this->Form->input('meta_keywords');
		echo $this->Form->input('meta_description');
		echo $this->Form->input('meta_title');
		echo $this->Form->input('slug');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Pages'), array('action' => 'index'));?></li>
	</ul>
</div>
