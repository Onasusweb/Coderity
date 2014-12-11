<?php
$loadMenu = $topMenu;
if (!empty($type) && $type == 'bottom') {
	$loadMenu = $bottomMenu;
}

if ($loadMenu) :
	// is there a ul class defined?
	if (!empty($ul['class'])) : ?>
		<ul class="<?php echo $ul['class']; ?>">
	<?php else : ?>
		<ul>
	<?php endif; ?>

	<?php foreach ($loadMenu as $menu) : ?>
		<li><?php echo $this->Html->link($menu['title'], $menu['url']); ?></li>
	<?php endforeach; ?></ul>
<?php endif; ?>