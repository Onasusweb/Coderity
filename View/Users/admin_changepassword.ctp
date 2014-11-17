<h1 class="title"><?php echo __('Change Password');?></h1>
<fieldset>
	<?php echo $this->Form->create('User', array('action' => 'changepassword'));?>
	<p><?php echo __('To change your password enter in your old password and your new password twice.'); ?></p>
	<?php
		echo $this->Form->input('old_password', array('value' => '', 'type' => 'password', 'required' => true));
		echo $this->Form->input('before_password', array('value' => '', 'type' => 'password', 'label' => __('New Password'), 'required' => true));
		echo $this->Form->input('retype_password', array('value' => '', 'type' => 'password', 'required' => true));
		echo $this->Form->end(__('Change Password'));
	?>
</fieldset>