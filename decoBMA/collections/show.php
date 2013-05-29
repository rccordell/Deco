<?php echo head(array('bodyid'=>'collections', 'bodyclass'=>'show','title'=>metadata('Collection', array('Dublin Core','Title')))); 
	$coll=get_current_record('Collections',false)->id;
	$total_results=metadata('Collection', 'total_items');
?>

<div id="primary" class="show">
    <h1><?php echo metadata('Collection',array('Dublin Core','Title')); ?></h1>
    <div id="collection-meta">
    
    <div id="description" class="element">
        <h2>Description</h2>
        <div class="element-text"><?php echo metadata('Collection',array('Dublin Core','Description')); ?></div>
    </div><!-- end description -->
    


    <p class="view-items-link">
    <?php 
    if($total_results>0){	
    	echo link_to_items_browse('View all '.$total_results.' items in ' . metadata('Collection',array('Dublin Core','Title')), array('collection' => $coll)); 
    	}else{
	    echo "<em>This collection has no items</em>";	
    	}?>
    </p>
    </div>
    
    <div id="collection-items">
    	    <?php
    	    
    	    $items=get_records('item',array('hasImage'=>true,'collection'=>$coll),$num=4);
    	    if(count($items)>=$num){
	        set_loop_records('items', $items);
	        if (has_loop_records('items')){
		        foreach (loop('items') as $item){
		        	echo link_to_item(item_image('square_thumbnail'));
		        	}
	        }
	        }?>
    </div><!-- end collection-items -->
    
    <?php echo fire_plugin_hook('append_to_collections_show');?>
</div><!-- end primary -->

<?php echo foot(); ?>