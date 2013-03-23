<?php echo head(array('title'=>'Browse Collections','bodyid'=>'collections','bodyclass' => 'browse')); ?>
<div id="primary">
	<h1>Collections</h1>
    <div class="pagination"><?php echo pagination_links(); ?></div>
		<?php 
		foreach(loop('Collection') as $collection):
		set_current_record('Collection',$collection);
		$collection= get_current_record('Collection');				
		?>
			<div class="collection">
			    
            	<h2><?php echo link_to_collection(); ?></h2>
	
            	<div class="element">
                <h3>Description</h3>
            	<div class="element-text">
	            <?php echo metadata('Collection', array('Dublin Core','Description'),array('snippet'=>250)); ?>	
            	</div>
	            </div>
	            

	
            	<p class="view-items-link">
            	<?php echo link_to_items_browse('View All Items',array('collection' => metadata('Collection','id'))); ?> <span class="separator">&mdash;</span> <?php echo link_to_collection('More Information'); ?>
            	
            <?php echo fire_plugin_hook('collections_browse_each'); ?>
            
            </div><!-- end class="collection" -->
		<?php endforeach; ?>
		
        <?php echo fire_plugin_hook('collections_browse'); ?>
</div><!-- end primary -->
			
<?php echo foot(); ?>