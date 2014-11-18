<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo __('Lead Details');?></h1>
	</div>
</div>

<div class="panel panel-default">
	<?php $name = trim($lead['Lead']['name']); ?>
	<div class="panel-heading">
		<?php if(!empty($name)) : ?>
			<?php echo $lead['Lead']['name']; ?>
		<?php endif; ?>
	</div>
	<div class="panel-body">
	<?php echo $this->Form->create();?>
		<dl class="dl-horizontal">
			<dt><?php echo __('Lead Type'); ?><dt>
			<dd><?php echo Inflector::humanize($lead['Lead']['type']); ?></dd>
		</dl>
		<?php if(!empty($name)) : ?>
			<dl class="dl-horizontal">
				<dt><?php echo __('Name'); ?><dt>
				<dd><?php echo $lead['Lead']['name']; ?><dd>
			</dl>
		<?php endif; ?>
		<dl class="dl-horizontal">
			<dt><?php echo __('Email Address'); ?><dt>
			<dd><a href="mailto:<?php echo $lead['Lead']['email']; ?>"><?php echo $lead['Lead']['email']; ?></a><dd>
		</dl>

		<?php if(!empty($lead['Lead']['phone'])) : ?>
			<dl class="dl-horizontal">
				<dt><?php echo __('Phone Number'); ?><dt>
				<dd><?php echo $lead['Lead']['phone']; ?><dd>
			</dl>
		<?php endif; ?>

		<?php if(!empty($lead['Lead']['version'])) : ?>
			<dl class="dl-horizontal">
				<dt><?php echo __('CakePHP Version'); ?><dt>
				<dd><?php echo $lead['Lead']['version']; ?><dd>
			</dl>
		<?php endif; ?>

		<?php if(!empty($lead['Lead']['website_type'])) : ?>
			<dl class="dl-horizontal">
				<dt><?php echo __('Website Type'); ?><dt>
				<dd><?php echo $lead['Lead']['website_type']; ?><dd>
			</dl>
		<?php endif; ?>

		<?php if(!empty($lead['Lead']['pages'])) : ?>
			<dl class="dl-horizontal">
				<dt><?php echo __('Number of Pages'); ?><dt>
				<dd><?php echo $lead['Lead']['pages']; ?><dd>
			</dl>
		<?php endif; ?>

		<?php if(!empty($lead['Lead']['requirements'])) : ?>
			<dl class="dl-horizontal">
				<dt><?php echo __('Website Requirements'); ?><dt>
				<dd><?php echo $lead['Lead']['requirements']; ?><dd>
			</dl>
		<?php endif; ?>

		<?php if(!empty($lead['Lead']['design'])) : ?>
			<dl class="dl-horizontal">
				<dt><?php echo __('Design Required'); ?><dt>
				<dd><?php echo __('Yes'); ?><dd>
			</dl>
		<?php endif; ?>

		<?php if(!empty($lead['Lead']['css'])) : ?>
			<dl class="dl-horizontal">
				<dt><?php echo __('CSS Required'); ?><dt>
				<dd><?php echo __('Yes'); ?><dd>
			</dl>
		<?php endif; ?>

		<?php if(!empty($lead['Lead']['message'])) : ?>
			<dl class="dl-horizontal">
				<dt><?php echo __('Enquiry'); ?><dt>
				<dd><?php echo nl2br($lead['Lead']['message']); ?><dd>
			</dl>
		<?php endif; ?>
		<dl class="dl-horizontal">
			<dt><?php echo __('Status'); ?><dt>
			<dd>
				<?php
					echo $this->Form->input('status',
							array('div' => 'form-group input-group input-group-small',
								  'label' => false,
								  'class' => 'form-control',
								  'value' => $lead['Lead']['status'],
								  'after' => $this->Form->submit(__('Update Status'),
																 array('div' => false,
																	   'class' => 'input-group-addon'))));
				?>
			<dd>
		</dl>
	<?php echo $this->Form->end();?>
	</div>
	<div class="panel-footer">
		<?php
			echo $this->Html->link(__('Back to Leads'),
								   array('action' => 'index'),
								   array('class' => 'btn btn-default'));
		?>
		<?php
			echo $this->Form->postLink(__('Delete this Lead'),
									   array('action' => 'delete',
											 $lead['Lead']['id'],
											 true),
									   array('confirm' => __('Are you sure you want to delete this lead?'),
											 'class' => 'btn btn-danger'));
		?>
	</div>
</div>