<div class="pages form">
<?php echo $this->Form->create('Page');?>
	<fieldset>
		<legend><?php echo __('Edit Page'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('type', array('options' => array('' => 'Default', 'about-us' => 'About Us', 'our-specialty' => 'Our Specialty')));
		echo $this->Form->input('is_active');
		echo $this->Editor->input('Page.content');
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
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Page.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Page.id'))); ?></li>
	</ul>
</div>
