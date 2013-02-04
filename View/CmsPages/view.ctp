<?php $this->append('cssClass', ' page-view'); ?>
<h1><?php echo h($page['Page']['title']); ?></h1>
<?php if (!empty($page['Page']['featured_image'])): ?>
	<?php echo $this->Html->image($page['Page']['featured_image'], array('class' => 'page-image-featured', 'alt' => $page['Page']['title'])); ?>
<?php endif; ?>
<?php echo $page['Page']['content']; ?>
<?php if (!empty($page['Page']['type'])): ?>
	<?php echo $this->Html->link(__('Back'), array('action' => 'index', $page['Page']['type']), array('class' => 'page-button-back')); ?>
<?php endif; ?>