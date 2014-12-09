<p><?php echo __('Hi %s,', Configure::read('Config.name'));?></p>

<p><?php echo __('The %s form has been submitted at %s.', $lead['Lead']['type'], Configure::read('Config.name'));?></p>

<p><?php echo __('The details are:');?></p>

<p><?php echo __('Name: %s', $lead['Lead']['name']); ?></p>

<p><?php echo __('Email Address: %s', $lead['Lead']['email']); ?></p>

<?php if (!empty($lead['Lead']['phone'])) : ?>
    <p><?php echo __('Phone Number: %s', $lead['Lead']['phone']); ?></p>
<?php endif; ?>

<p>
    <?php echo __('Message:'); ?><br />
    <?php echo nl2br($lead['Lead']['message']); ?>
</p>