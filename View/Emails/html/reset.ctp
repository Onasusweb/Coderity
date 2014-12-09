<p><?php echo __('Hi %s,', $data['User']['first_name']);?></p>

<p><?php echo __('Your password has been reset at %s.', Configure::read('Config.name'));?></p>

<p><?php echo __('Your login details are:');?><br />
<?php echo __('Username');?>: <?php echo $data['User']['username'];?><br />
<?php echo __('Password');?>: <?php echo $data['User']['before_password'];?>
</p>

<?php echo __('We recommend you change your password when you login.');?>

<p><?php echo __('Thank You');?><br/>
<?php echo Configure::read('Config.name');?></p>
