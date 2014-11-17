<h1 class="page-header"><?php echo __('Site Settings'); ?></h1>

<div class="panel panel-default">
	<?php if ($settings) : ?>
	    <div class="panel-heading">
	    	<?php echo __('Settings'); ?>
	    </div>
	    <div class="panel-body">
			<?php echo $this->element('admin/pagination'); ?>
            <div class="table-responsive">
				<table class="table table-striped table-hover dataTable" summary="<?php __('List of Blog Articles'); ?>">
					<thead>
						<tr>
							<th><?php echo $this->Paginator->sort('name'); ?></th>
							<th><?php echo $this->Paginator->sort('modified', __('Last Modified')); ?></th>
							<th class="actions"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($settings as $setting): ?>
							<tr>
								<td><?php echo Inflector::Humanize($setting['Setting']['name']); ?></td>
								<td><?php echo $this->Time->niceShort($setting['Setting']['modified']); ?></td>
								<td class="actions">
									<?php
									echo $this->Html->link('<i class="fa fa-edit"></i>',
														   array('action' => 'edit',
														   		 $setting['Setting']['id']),
														   array('class' => 'btn btn-warning',
														   		 'escape' => false,
														   		 'alt' => __('Edit'),
														   		 'title' => __('Edit')));
									?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
    		</div>
    	</div>
	<?php else: ?>
	    <div class="panel-body">
			<p class="no-content"><?php echo __('There are no settings at the moment.');?></p>
		</div>
	<?php endif; ?>
</div>