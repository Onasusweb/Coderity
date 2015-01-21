<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only"><?php echo __('Toggle navigation'); ?></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>

	</div>
	<!-- /.navbar-header -->

	<ul class="nav navbar-top-links navbar-right">
		<li>
		<?php echo $this->Html->link('<i class="fa fa-file-picture-o fa-fw"></i> ' . __('View Site'), '/', array('target' => '_blank', 'escape' => false)); ?>
		</li>
		<?php if (AuthComponent::user('id')) : ?>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
				</a>
				<ul class="dropdown-menu dropdown-user">
					<li>
						<?php echo $this->Html->link('<i class="fa fa-user fa-fw"></i> ' . __('Change Password'), array('plugin' => false, 'controller' => 'users', 'action' => 'password'), array('escape' => false)); ?>
					</li>
					<li class="divider"></li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-sign-out fa-fw"></i> ' . __('Logout'), array('plugin' => false, 'controller' => 'users', 'action' => 'logout'), array('escape' => false)); ?>
					</li>
				</ul>
				<!-- /.dropdown-user -->
			</li>
			<!-- /.dropdown -->
		<?php endif; ?>
	</ul>
	<!-- /.navbar-top-links -->

	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">
				<li>
				<?php echo $this->Html->image('Coderity.logo.png', array('url' => array('controller' => 'users', 'action' => 'home')), array('class' => 'navbar-brand')); ?>
				</li>
				<?php if (AuthComponent::user('id')) : ?>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-dashboard fa-fw"></i> ' . __('Home'), array('plugin' => false, 'controller' => 'users', 'action' => 'home'), array('escape' => false)); ?>
					</li>

					<li>
						<?php echo $this->Html->link('<i class="fa fa-sitemap fa-fw"></i> ' . __('Pages'), array('plugin' => false, 'controller' => 'pages', 'action' => 'index'), array('escape' => false)); ?>
					</li>

					<?php if (!Configure::read('Coderity') || Configure::read('Coderity.blocks')) : ?>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-share-alt fa-fw"></i> ' . __('Content Blocks'), array('plugin' => false, 'controller' => 'blocks', 'action' => 'index'), array('escape' => false)); ?>
						</li>
					<?php endif; ?>

					<?php if (!Configure::read('Coderity') || Configure::read('Coderity.articles')) : ?>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-quote-right fa-fw"></i> ' . __('Articles'), array('plugin' => false, 'controller' => 'articles', 'action' => 'index'), array('escape' => false)); ?>
						</li>
					<?php endif; ?>

					<?php if (!Configure::read('Coderity') || Configure::read('Coderity.leads')) : ?>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-star-o fa-fw"></i> ' . __('Leads'), array('plugin' => false, 'controller' => 'leads', 'action' => 'index'), array('escape' => false)); ?>
						</li>
					<?php endif; ?>

					<li>
						<?php echo $this->Html->link('<i class="fa fa-users fa-fw"></i> ' . __('Admin Users'), array('plugin' => false, 'controller' => 'users', 'action' => 'index'), array('escape' => false)); ?>
					</li>

					<?php if (!Configure::read('Coderity') || Configure::read('Coderity.redirects')) : ?>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-exchange fa-fw"></i> ' . __('Redirects'), array('plugin' => false, 'controller' => 'redirects', 'action' => 'index'), array('escape' => false)); ?>
						</li>
					<?php endif; ?>

					<?php if (Configure::read('Coderity.additionalAdminMenu')) :
						foreach (Configure::read('Coderity.additionalAdminMenu') as $menuName => $linkDetails) : ?>
							<li>
								<?php
									if (!empty($linkDetails['icon'])) {
										$menuName = '<i class="fa ' . $linkDetails['icon'] .' fa-fw"></i> ' . $menuName;
									}

									echo $this->Html->link($menuName, $linkDetails['url'], array('escape' => false));
								?>
							</li>
						<?php endforeach;
					endif; ?>

					<li>
						<?php echo $this->Html->link('<i class="fa fa-table fa-fw"></i> ' . __('Settings'), array('plugin' => false, 'controller' => 'settings', 'action' => 'index'), array('escape' => false)); ?>
					</li>

					<li>
						<?php echo $this->Html->link('<i class="fa fa-sign-out fa-fw"></i> ' . __('Logout'), array('plugin' => false, 'controller' => 'users', 'action' => 'logout'), array('escape' => false)); ?>
					</li>
				<?php endif; ?>
			</ul>
		</div>
		<!-- /.sidebar-collapse -->
	</div>
	<!-- /.navbar-static-side -->
</nav>