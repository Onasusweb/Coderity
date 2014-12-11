<?php echo $this->element('admin/header', array(), array('plugin' => 'Coderity')); ?>

<div id="wrapper">
	<?php echo $this->element('admin/menu', array(), array('plugin' => 'Coderity')); ?>

	<div id="page-wrapper">
		<?php
			echo $this->Session->flash();
			echo $this->fetch('content');
		?>
	</div>
</div>

<?php echo $this->element('admin/footer', array(), array('plugin' => 'Coderity')); ?>