<?php $this->append('cssClass', ' page-index'); ?>
<?php foreach ($pages as $page): ?>
	<article>
		<h1><?php echo h($page['Page']['title']); ?></h1>
		<?php if (!empty($page['Page']['preview_image'])): ?>
			<?php echo $this->Html->image($page['Page']['preview_image'], array('class' => 'page-image-preview', 'alt' => $page['Page']['title'])); ?>
		<?php endif; ?>
		<p><?php echo $page['Page']['preview']; ?></p>
		<?php echo $this->Html->link(__('Read More'), $page['Page']['url'], array('class' => 'page-button-more')); ?>
	</article>
<?php endforeach; ?>