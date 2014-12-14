<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="login-panel panel panel-default ">
			<div class="panel-heading">
				<?php echo __('Reset Password');?>
			</div>
			<div class="panel-body">
				<fieldset>
					<div class="form-group">
						<p><?php echo __('If you have forgotten your username or password simply enter in your email address below.');?></p>
						<p><?php echo __('We will email your username and a new password to you.');?></p>
					</div>
					<?php echo $this->Form->create('User', array('action' => 'reset'));?>
					<div class="form-group">
						<?php
							echo $this->Form->input('email',
													array('placeholder' => __('Enter Your Email'),
														  'label' => false,
														  'class' => 'form-control',
														  'autofocus' => 'autofocus'));
						?>
					</div>
					<div class="form-group">
						<?php
							echo $this->Form->button(__('Reset Password'),
													 array('type' => 'submit',
														   'class' => 'btn btn-lg btn-success btn-block'));
						?>
					</div>
					<?php echo $this->Form->end(); ?>
				</fieldset>
			</div>
			<div class="panel-footer">
				<p>
					<?php echo $this->Html->link(__('Back to Login Page'),
												 array('action'=>'login'));?>
				</p>
			</div>
		</div>
	</div>
</div>