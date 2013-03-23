<?php echo head(array('title'=>'Browse Items','bodyid'=>'items','bodyclass'=>'tags')); ?>

<div id="primary">
	
	<h1>Browse Tags</h1>
	
	<ul class="navigation item-tags" id="secondary-nav">
	<?php 
		$navArray = array(
		array('label'=>'Browse All', 'uri'=>url('items')),
		array('label'=>'Browse By Tag', 'uri'=>url('items/tags'))
		);
		echo nav($navArray);			
	?>
	</ul>

	<?php echo tag_cloud($tags,url('items/browse')); ?>

</div><!-- end primary -->

<?php echo foot(); ?>