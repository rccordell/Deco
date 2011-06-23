<?php $current = Omeka_Context::getInstance()->getCurrentUser();
		if ($current->role == 'super'):?>

<?php head(array('title'=>'Browse Items','bodyid'=>'items','bodyclass'=>'tags')); ?>

<div id="primary">
	
	<h1>Browse Items</h1>
	
	<ul class="navigation item-tags" id="secondary-nav">
	<?php echo nav(array('Browse All' => uri('items/browse'), 'Browse by Tag' => uri('items/tags'))); ?>
	</ul>

	<?php echo tag_cloud($tags,uri('items/browse')); ?>

</div><!-- end primary -->

<?php foot(); ?>

<?php else:?>

<?php head(array('title'=>'404','bodyid'=>'404')); ?>

<div id="primary">
	
<h2>Oops!</h2>
	
	<p>Sorry, this page doesn't exist. Check your URL, or send us a note.</p>

</div><!-- end primary -->

<?php foot(); ?>

<?php endif; ?>