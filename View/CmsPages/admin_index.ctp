<?php
	$this->assign('title', __d('awecms_content', 'Pages'));
	$this->assign('class', 'index');
?>
<table class="table table-striped table-hover">
<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('title');?></th>
		<th><?php echo $this->Paginator->sort('type');?></th>
		<th><?php echo $this->Paginator->sort('slug');?></th>
		<th><?php echo $this->Paginator->sort('is_active');?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
</thead>
<tbody>
	<?php foreach ($pages as $page): ?>
		<tr>
			<td><?php echo $this->Html->link($page['Page']['title'], array('action' => 'edit', $page['Page']['id'])); ?>&nbsp;</td>
			<td><?php echo h($page['Page']['type']); ?>&nbsp;</td>
			<td><?php echo h($page['Page']['slug']); ?>&nbsp;</td>
			<td><?php echo $page['Page']['is_active'] ? __('Yes') : __('No'); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $page['Page']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $page['Page']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $page['Page']['id']), null, __('Are you sure you want to delete # %s?', $page['Page']['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
</tbody>
</table>
<p class="pagination-counter">
<?php
	echo $this->Paginator->counter(array(
			'format' => __d('awecms', 'Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
		));
?>
</p>
<div class="paging">
<?php
	echo $this->TwitterPaginator->pagination();
?>
</div>