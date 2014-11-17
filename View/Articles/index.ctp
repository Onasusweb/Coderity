<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <?php if (!empty($page['Page']['content'])) {
                	echo $page['Page']['content'];
                } ?>
            </div>

            <?php if ($articles) : ?>
	            <?php foreach ($articles as $article) : ?>
		            <div class="col-lg-12 text-center">
                        <?php
                            $image = 'slide-1.jpg';
                            if (!empty($article['Article']['image'])) {
                                $image = 'uploads/thumbs/' . $article['Article']['image'];
                            }
                            echo $this->Html->link($this->Html->image($image, array('class' => 'img-responsive img-border img-full')), array('action' => 'view', $article['Article']['slug']), array('escape' => false, 'alt' => $article['Article']['title'], 'title' => $article['Article']['title'])); ?>

		                <h2><?php echo $this->Html->link($article['Article']['title'], array('action' => 'view', $article['Article']['slug'])); ?>
		                    <br>
		                    <small><?php echo $this->Time->format('jS F Y', $article['Article']['date']); ?></small>
		                </h2>
		                <p><?php echo $article['Article']['brief']; ?></p>
                        <?php echo $this->Html->link(__('Read More'), array('action' => 'view', $article['Article']['slug']), array('class' => 'btn btn-default btn-lg')); ?>
		                <hr>
		            </div>
		        <?php endforeach; ?>

	            <div class="col-lg-12 text-center">
	                <ul class="pager">
	                    <?php if ($this->Paginator->hasPrev()) : ?>
                            <li class="previous">
                                <?php echo $this->Paginator->prev(__('%s Older', '&larr;'), array('escape' => false)); ?>
                            </li>
                        <?php endif; ?>

                        <?php if ($this->Paginator->hasNext()) : ?>
                            <li class="next">
                                <?php echo $this->Paginator->next(__('Newer %s', '&rarr;'), array('escape' => false)); ?>
                            </li>
                        <?php endif; ?>
	                </ul>
	            </div>
	        <?php endif; ?>
        </div>
    </div>
</div>
<!-- /.container -->