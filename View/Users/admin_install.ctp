<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo __('Welcome to Coderity');?></h1>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h1><?php echo __('Install Coderity'); ?></h1>

		<p><?php echo __('Welcome to Coderity CMS.  Please enter in the following details to create the default Admin user.'); ?></p>
	</div>
	<div class="panel-body">
		<?php
			echo $this->Form->create();
			echo $this->Form->input('admin', array('type' => 'hidden', 'value' => true));
		?>
			<fieldset>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<?php
								echo $this->Form->input('first_name',
														array('class' => 'form-control'));
							?>
						</div>
						<div class="form-group">
							<?php
								echo $this->Form->input('last_name',
														array('class' => 'form-control'));
							?>
						</div>
						<div class="form-group">
							<?php
								echo $this->Form->input('email',
														array('class' => 'form-control'));
							?>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<?php
								echo $this->Form->input('username',
														array('class' => 'form-control'));
							?>
						</div>
						<div class="form-group">
							<?php
								echo $this->Form->input('password',
														array('class' => 'form-control'));
							?>
						</div>
						<div class="form-group">
							<?php
								echo $this->Form->input('retype_password',
														array('type'  => 'password',
															  'class' => 'form-control'));
							?>
						</div>
					</div>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Install Coderity'),
												   array('class' => 'btn btn-primary'));?>
				</div>
			</fieldset>
		<?php echo $this->Form->end();?>
	</div>
</div>