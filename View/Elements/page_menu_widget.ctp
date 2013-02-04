<ul>
	<?php foreach ($pages as $page): ?>
		<li><?php echo $this->Html->link($page['Page']['title'], $page['Page']['url']); ?></li>
	<?php endforeach; ?>
</ul>