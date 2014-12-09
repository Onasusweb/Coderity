<?php echo __('Hi %s,', $data['User']['first_name']);?>


<?php echo __('Your password has been reset at %s.', Configure::read('Config.name'));?>


<?php echo __('Your login details are:');?>


<?php echo __('Username');?>: <?php echo $data['User']['username'];?>

<?php echo __('Password');?>: <?php echo $data['User']['before_password'];?>


<?php echo __('We recommend you change your password when you login.');?>


<?php echo __('Thank You');?>

<?php echo Configure::read('Config.name');?>