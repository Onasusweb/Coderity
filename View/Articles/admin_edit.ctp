<?php
	$this->Html->addCrumb(__('Manage Articles'), array('action' => 'index'));
	$this->Html->addCrumb(__('Add'), array('action' => 'add'));
	echo $this->element('admin/crumb');
?>

<h1 class="page-header"><?php echo __('Edit Article');?></h1>

<div class="panel panel-default">
    <div class="panel-heading">
		<?php echo __('Article Details');?>
    </div>
	<div class="panel-body">
		<?php
			echo $this->Form->create('Article', array('type' => 'file'));
			echo $this->Form->input('id');
		?>
			<fieldset>
				<div class="form-group">
					<?php
						echo $this->Form->input('title',
												array('class' => 'form-control'));
					?>
				</div>
				<div class="form-group">
					<?php
						echo $this->Form->input('brief',
												array('class' => 'form-control'));
					?>
				</div>
				<div class="form-group">
					<?php echo $this->Ck->input('content'); ?>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<?php
								echo $this->Form->input('meta_description',
														array('class' => 'form-control'));
							?>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<?php
								echo $this->Form->input('meta_keywords',
														array('class' => 'form-control'));
							?>
						</div>
					</div>
				</div>
				<?php if (!empty($this->request->data['Article']['image'])
						  && (!is_array($this->request->data['Article']['image']))) :
				?>
					<div class="form-group cms-item-current-image">
						<label><?php echo __('Current Image');?>:</label>
						<?php
							echo $this->Html->image('uploads/thumbs/' . $this->request->data['Article']['image']);
						?>
					</div>
					<div class="form-group">
						<?php echo $this->Form->checkbox('image_delete',
														 array('value' => $this->request->data['Article']['id'])); ?>
						<?php echo __('Delete this image?');?>
					</div>
				<?php endif; ?>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<?php
								echo $this->Form->input('image',
														array('type' => 'file',
															  'class' => 'form-control'));
							?>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<?php
								echo $this->Form->input('date',
														array('class' => 'datepicker',
														 	  'label' => array('text' => __('Date'), 			'class' => 'datepicker-label')));
							?>
						</div>
					</div>
				</div>
				<div class="form-group">
				<?php echo $this->Form->submit(__('Save Changes'),
											   array('class' => 'btn btn-primary'));?>
				</div>
			</fieldset>
		<?php echo $this->Form->end();?>
    </div>
    <div class="panel-footer">
		<?php echo $this->Html->link(__('Back to Articles'),
									 array('action' => 'index'),
									 array('class' => 'btn btn-default'));?>
	</div>
</div>