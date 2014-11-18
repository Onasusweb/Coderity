<?php
$loadMenu = $topMenu;
if (!empty($type) && $type == 'bottom') {
    $loadMenu = $bottomMenu;
}

if ($loadMenu) : ?>
<ul>
    <?php foreach ($loadMenu as $menu) : ?>
        <li><?php echo $this->Html->link($menu['title'], $menu['url']); ?></li>
    <?php endforeach; ?></ul>
<?php endif; ?>