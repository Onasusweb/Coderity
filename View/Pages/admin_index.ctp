<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			<?php if(!empty($parent)) : ?>
				<?php echo sprintf(__('Subpages of: %s'), $parent['Page']['name']);?>
			<?php else : ?>
				<?php echo __('Website Content');?>
			<?php endif; ?>
		</h1>
	</div>
</div>

<div class="well">
	<?php echo $this->Form->create('Page', array('action' => 'index'));?>
		<fieldset class="form-group">
			<div class="input-group custom-search-form">
				<?php if (!empty($search)) : ?>
					<?php echo $this->Form->input('search', array('class' => 'form-control', 'label' => false, 'div' => false, 'value' => $search));?>
				<?php else : ?>
					<?php echo $this->Form->input('search',
												  array('type' => 'text',
														'class' => 'form-control',
														'placeholder' => 'Search...',
														'label' => false,
														'div' => false));?>
				<?php endif; ?>

				<span class="input-group-btn">
						<?php echo $this->Form->button('<i class="fa fa-search"></i>',
													   array('class' => 'btn btn-default',
															 'escape' => false,
															 'type' => 'submit',
															 'div' => false));?>
					</span>
			</div>
			<!-- /input-group -->
		</fieldset>
		<?php if (!empty($search)) : ?>
			<?php echo $this->Html->link(__('Reset'), array('action' => 'index')); ?>
		<?php endif; ?>
	<?php echo $this->Form->end();?>
	<?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add a new page'),
								 array('action' => 'add', $parent_id),
								 array('class' => 'btn btn-primary',
									   'escape' => false)); ?>
</div>

<?php //if (Configure::read('Content.topMenu')) : ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo __('Top Menu Pages');?>
		</div>
		<div class="panel-body">
			<?php if (!empty($topPages)) : ?>
			<div class="alert alert-info">
				<i class="fa fa-info-circle"></i>
				<?php echo __('To change the order that the pages are displayed, drag and drop the ordering by clicking and draging on the table below.');?>
			</div>
			<div id="orderMessageTop" class="success" style="display: none"></div>
			<div class="table-responsive">
				<table id="pageListTop" class="table table-striped table-hover dataTable" summary="<?php __('List of Top Menu Pages'); ?>">
					<tr>
						<th><?php echo __('Name');?></th>
						<th><?php echo __('Last Modified');?></th>
						<th class="actions"><?php echo __('Options');?></th>
					</tr>
					<?php
					$i = 0;
					foreach ($topPages as $page):
						$class = null;
						if ($i++ % 2 == 0) {
							$class = ' class="altrow sortable_top"';
						}else{
							$class = ' class="sortable_top"';
						}
					?>
						<tr <?php echo $class;?> id="page_<?php echo $page['Page']['id'];?>">
							<td>
								<?php echo $page['Page']['name']; ?>
							</td>
							<td>
								<?php echo $this->Time->niceShort($page['Page']['modified']); ?>
							</td>
							<td class="actions">
								<?php
								if (!empty($page['Page']['route'])) {
									$page['Page']['slug'] = $page['Page']['route'];
								} else {
									$page['Page']['slug'] = '/' . $page['Page']['slug'];
								}

								echo $this->Html->link('<i class="fa fa-picture-o"></i>',
														   $page['Page']['slug'],
														   array('class' => 'btn btn-primary',
																 'escape' => false,
																 'alt' => __('View'),
																 'title' => __('View'),
																 'target' => '_blank'));
																 ?>
								<?php
								echo $this->Html->link('<i class="fa fa-edit"></i>',
														   array('action' => 'edit',
																 $page['Page']['id']),
														   array('class' => 'btn btn-warning',
																 'escape' => false,
																 'alt' => __('Edit'),
																 'title' => __('Edit')));
								?>
								<?php if(!empty($page['Page']['children'])) : ?>
									<?php
										echo $this->Html->link(__('Subpages'),
															   array('action' => 'index',
																	 $page['Page']['id']),
															   array('class' => 'btn btn-primary',
																	 'escape' => false));
									?>
								<?php endif; ?>
								<?php if(!empty($page['Page']['form'])) : ?>
									<?php
										echo $this->Html->link(__('Custom Form'),
															   array('controller'=> 'fields',
																	 'action' => 'page',
																	 $page['Page']['id']),
															   array('class' => 'btn btn-primary',
																	 'escape' => false));
									?>
								<?php endif; ?>
								<?php if(!empty($page['Revision'])) : ?>
									<?php
										echo $this->Html->link(__('Previous Versions'),
															   array('controller' => 'revisions',
																	 'action' => 'view',
																	 $page['Page']['id']),
															   array('class' => 'btn btn-primary',
																	 'escape' => false));
									?>
								<?php endif; ?>
								<?php
									echo $this->Html->link('<i class="fa fa-copy"></i>',
														   array('action' => 'add',
																 0,
																 $page['Page']['id']),
														   array('class' => 'btn btn-primary',
																 'escape' => false,
																 'alt' => __('Duplicate'),
																 'title' => __('Duplicate')));
								?>
								<?php if(empty($page['Page']['permanent'])) : ?>
									<?php
										echo $this->Form->postLink('<i class="fa fa-trash-o"></i>',
																   array('action' => 'delete',
																		 $page['Page']['id']),
																   array('class' => 'btn btn-danger',
																		 'escape' => false,
																		 'alt' => __('Delete'),
																		 'title' => __('Delete'),
																		 'confirm' => __('Are you sure you want to delete the page %s?',
																						 $page['Page']['name'])));
									?>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
			<?php else:?>
				<p class="no-content">
					<?php echo __('There are no top menu pages at the moment.');?>
				</p>
			<?php endif;?>
		</div>
	</div>
<?php //endif;?>

<?php //if (Configure::read('Content.bottomMenu')) : ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo __('Bottom Menu Pages');?>
		</div>
		<div class="panel-body">
			<?php if(!empty($bottomPages)):?>
			<div class="alert alert-info">
				<i class="fa fa-info-circle"></i>
				<?php echo __('To change the order that the pages are displayed, drag and drop the ordering by clicking and draging on the table below.');?>
			</div>
			<div id="orderMessageBottom" class="message" style="display: none"></div>
			<div class="table-responsive">
				<table id="pageListBottom" class="table table-striped table-hover dataTable" summary="<?php __('List of Bottom Menu Pages'); ?>">
					<tr>
						<th><?php echo __('Name');?></th>
						<th><?php echo __('Last Modified');?></th>
						<th class="actions"><?php echo __('Options');?></th>
					</tr>
					<?php
					$i = 0;
					foreach ($bottomPages as $page):
						$class = null;
						if ($i++ % 2 == 0) {
							$class = ' class="altrow sortable_bottom"';
						}else{
							$class = ' class="sortable_bottom"';
						}
					?>
						<tr <?php echo $class;?> id="page_<?php echo $page['Page']['id'];?>">
							<td>
								<?php echo $page['Page']['name']; ?>
							</td>
							<td>
								<?php echo $this->Time->niceShort($page['Page']['modified']); ?>
							</td>
							<td class="actions">
								<?php
								if (!empty($page['Page']['route'])) {
									$page['Page']['slug'] = $page['Page']['route'];
								} else {
									$page['Page']['slug'] = '/' . $page['Page']['slug'];
								}

								echo $this->Html->link('<i class="fa fa-picture-o"></i>',
														   $page['Page']['slug'],
														   array('class' => 'btn btn-primary',
																 'escape' => false,
																 'alt' => __('View'),
																 'title' => __('View'),
																 'target' => '_blank'));
																 ?>
								<?php
									echo $this->Html->link('<i class="fa fa-edit"></i>',
														   array('action' => 'edit',
																 $page['Page']['id']),
														   array('class' => 'btn btn-warning',
																 'escape' => false,
																 'alt' => __('Edit'),
																 'title' => __('Edit')));
								?>
								<?php if(!empty($page['Page']['children'])) : ?>
									<?php
										echo $this->Html->link(__('Subpages'),
															   array('action' => 'index',
																	 $page['Page']['id']),
															   array('class' => 'btn btn-primary',
																	 'escape' => false));
									?>
								<?php endif; ?>
								<?php if(!empty($page['Page']['form'])) : ?>
									<?php
										echo $this->Html->link(__('Custom Form'),
															   array('controller'=> 'fields',
																	 'action' => 'page',
																	 $page['Page']['id']),
															   array('class' => 'btn btn-primary',
																	 'escape' => false));
									?>
								<?php endif; ?>
								<?php if(!empty($page['Revision'])) : ?>
									<?php
										echo $this->Html->link(__('Previous Versions'),
															   array('controller' => 'revisions',
																	 'action' => 'view',
																	 $page['Page']['id']),
															   array('class' => 'btn btn-primary',
																	 'escape' => false));
									?>
								<?php endif; ?>
								<?php
									echo $this->Html->link('<i class="fa fa-copy"></i>',
														   array('action' => 'add',
																 0,
																 $page['Page']['id']),
														   array('class' => 'btn btn-primary',
																 'escape' => false,
																 'alt' => __('Duplicate'),
																 'title' => __('Duplicate')));
								?>
								<?php if(empty($page['Page']['permanent'])) : ?>
									<?php
										echo $this->Form->postLink('<i class="fa fa-trash-o"></i>',
																   array('action' => 'delete',
																		 $page['Page']['id']),
																   array('class' => 'btn btn-danger',
																		 'escape' => false,
																		 'alt' => __('Delete'),
																		 'title' => __('Delete'),
																		 'confirm' => __('Are you sure you want to delete the page %s?',
																						 $page['Page']['name'])));
									?>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
			<?php else:?>
				<p class="no-content">
					<?php echo __('There are no bottom menu pages at the moment.');?>
				</p>
			<?php endif;?>
		</div>
	</div>
<?php //endif;?>

<div class="panel panel-default">
	<div class="panel-heading">
		<?php echo __('Static Pages');?>
	</div>
	<div class="panel-body">
		<div class="alert alert-info">
			<i class="fa fa-info-circle"></i>
			<?php echo __('Static pages are not assigned to either the top menu or the bottom menu.');?>
		</div>
		<?php if(!empty($staticPages)):?>
			<div class="table-responsive">
				<table id="pageList" class="table table-striped table-hover dataTable" summary="<?php __('List of Static Pages'); ?>">
					<tr>
						<th><?php echo __('Name');?></th>
						<th><?php echo __('Last Modified');?></th>
						<th class="actions"><?php echo __('Options');?></th>
					</tr>
					<?php
					$i = 0;
					foreach ($staticPages as $page):
						$class = null;
						if ($i++ % 2 == 0) {
							$class = ' class="altrow"';
						}
					?>
						<tr <?php echo $class;?>>
							<td>
								<?php echo $page['Page']['name']; ?>
							</td>
							<td>
								<?php echo $this->Time->niceShort($page['Page']['modified']); ?>
							</td>
							<td class="actions">
								<?php
								if (!empty($page['Page']['route'])) {
									$page['Page']['slug'] = $page['Page']['route'];
								} else {
									$page['Page']['slug'] = '/' . $page['Page']['slug'];
								}

								echo $this->Html->link('<i class="fa fa-picture-o"></i>',
														   $page['Page']['slug'],
														   array('class' => 'btn btn-primary',
																 'escape' => false,
																 'alt' => __('View'),
																 'title' => __('View'),
																 'target' => '_blank'));
																 ?>
								<?php
									echo $this->Html->link('<i class="fa fa-edit"></i>',
														   array('action' => 'edit',
																 $page['Page']['id']),
														   array('class' => 'btn btn-warning',
																 'escape' => false,
																 'alt' => __('Edit'),
																 'title' => __('Edit')));
								?>
								<?php if(!empty($page['Page']['children'])) : ?>
									<?php
										echo $this->Html->link(__('Subpages'),
															   array('action' => 'index',
																	 $page['Page']['id']),
															   array('class' => 'btn btn-primary',
																	 'escape' => false));
									?>
								<?php endif; ?>
								<?php if(!empty($page['Page']['form'])) : ?>
									<?php
										echo $this->Html->link(__('Custom Form'),
															   array('controller'=> 'fields',
																	 'action' => 'page',
																	 $page['Page']['id']),
															   array('class' => 'btn btn-primary',
																	 'escape' => false));
									?>
								<?php endif; ?>
								<?php if(!empty($page['Revision'])) : ?>
									<?php
										echo $this->Html->link(__('Previous Versions'),
															   array('controller' => 'revisions',
																	 'action' => 'view',
																	 $page['Page']['id']),
															   array('class' => 'btn btn-primary',
																	 'escape' => false));
									?>
								<?php endif; ?>
								<?php
									echo $this->Html->link('<i class="fa fa-copy"></i>',
														   array('action' => 'add',
																 0,
																 $page['Page']['id']),
														   array('class' => 'btn btn-primary',
																 'escape' => false,
																 'alt' => __('Duplicate'),
																 'title' => __('Duplicate')));
								?>
								<?php if(empty($page['Page']['permanent'])) : ?>
									<?php
										echo $this->Form->postLink('<i class="fa fa-trash-o"></i>',
																   array('action' => 'delete',
																		 $page['Page']['id']),
																   array('class' => 'btn btn-danger',
																		 'escape' => false,
																		 'alt' => __('Delete'),
																		 'title' => __('Delete'),
																		 'confirm' => __('Are you sure you want to delete the page %s?',
																						 $page['Page']['name'])));
									?>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
		<?php else:?>
			<p class="no-content"><?php echo __('There are no static pages at the moment.');?></p>
		<?php endif;?>
	</div>
</div>

<?php if(Configure::read('Content.pageElements')) : ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo __('Page Elements');?>
		</div>
		<div class="panel-body">
			<div class="alert alert-info">
				<i class="fa fa-info-circle"></i>
				<?php echo __('Page elements are mini content areas used in various parts of the website.');?>
			</div>
			<?php if(!empty($pageElements)):?>
			<div class="table-responsive">
				<table id="pageList" class="table table-striped table-hover dataTable" summary="<?php __('List of Page Elements'); ?>">
					<tr>
						<th><?php echo __('Name');?></th>
						<th><?php echo __('Last Modified');?></th>
						<th class="actions"><?php echo __('Options');?></th>
					</tr>
					<?php
					$i = 0;
					foreach ($pageElements as $page):
						$class = null;
						if ($i++ % 2 == 0) {
							$class = ' class="altrow"';
						}
					?>
						<tr <?php echo $class;?>>
							<td>
								<?php echo $page['Page']['name']; ?>
							</td>
							<td>
								<?php echo $this->Time->niceShort($page['Page']['modified']); ?>
							</td>
							<td class="actions">
								<?php
									echo $this->Html->link('<i class="fa fa-edit"></i>',
														   array('action' => 'edit',
																 $page['Page']['id']),
														   array('class' => 'btn btn-warning',
																 'escape' => false,
																 'alt' => __('Edit'),
																 'title' => __('Edit')));
								?>
								<?php if(!empty($page['Revision'])) : ?>
									<?php
										echo $this->Html->link(__('Previous Versions'),
															   array('controller' => 'revisions',
																	 'action' => 'view',
																	 $page['Page']['id']),
															   array('class' => 'btn btn-primary',
																	 'escape' => false));
									?>
								<?php endif; ?>
								<?php if(empty($page['Page']['permanent'])) : ?>
									<?php
										echo $this->Form->postLink('<i class="fa fa-trash-o"></i>',
																   array('action' => 'delete',
																		 $page['Page']['id']),
																   array('class' => 'btn btn-danger',
																		 'escape' => false,
																		 'alt' => __('Delete'),
																		 'title' => __('Delete'),
																		 'confirm' => __('Are you sure you want to delete the page %s?',
																						 $page['Page']['name'])));
									?>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
			<?php else:?>
				<p class="no-content"><?php echo __('There are no page elements at the moment.');?></p>
			<?php endif;?>
		</div>
	</div>
<?php endif;?>

<div class="well">
	<?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add a new page'),
								 array('action' => 'add', $parent_id),
								 array('class' => 'btn btn-primary',
									   'escape' => false)); ?>
</div>

<script type="text/javascript">
	<?php if(Configure::read('Content.topMenu')) : ?>
		$('#pageListTop').sortable({
			'axis': 'y',
			'items': 'tr.sortable_top',
			'opacity': 50,
			update: function(){
				$.ajax({
					url: '/admin/pages/save/top',
					type: 'POST',
					data: $(this).sortable('serialize'),
					success: function(data){
						$('#orderMessageTop').html(data).show('fast').animate({opacity: 1.0}, 2000).fadeOut('slow');
					}
				});
			}
		});
	<?php endif; ?>

	<?php if(Configure::read('Content.bottomMenu')) : ?>
		$('#pageListBottom').sortable({
			'axis': 'y',
			'items': 'tr.sortable_bottom',
			'opacity': 50,
			update: function(){
				$.ajax({
					url: '/admin/pages/save/bottom',
					type: 'POST',
					data: $(this).sortable('serialize'),
					success: function(data){
						$('#orderMessageBottom').html(data).show('fast').animate({opacity: 1.0}, 2000).fadeOut('slow');
					}
				});
			}
		});
	<?php endif; ?>
</script>