<?php
	$options = array(1 => __('Yes'), 0 => __('No'));
?>

<section id="content" class="gradientbg2">
	<div class="row">
		<div class="large-9 columns">
			<section id="main">
				<h1>User Survey</h1>

				<p>Please help us provide you with a better experience on MrBuyGuy.com by answering these simple questions:</p>

				<?php
					echo $this->Form->create('Lead');

					echo $this->Form->input('like_look_of_website', array('label' => __('Overall, did you like the look of the website?'), 'options' => $options, 'empty' => __('Select')));
					echo $this->Form->input('like_look_of_website_comment', array('label' => __('Leave a comment (optional)')));


					echo $this->Form->submit(__('Submit'));
					echo $this->Form->end();
				?>
			</section><!-- Ends main -->
		</div><!-- Ends large-9 column -->

		<div class="large-3 columns">
			<section id="rightside" class="bg">
				<?php echo $this->element('element', array('slug' => 'right-side')); ?>
			</section><!-- Ends rightside -->
		</div><!-- Ends large-3 column -->
	</div><!-- Ends row -->
</section><!-- Ends content -->