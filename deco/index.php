<?php echo head(array('bodyid'=>'home')); ?> 
    <div id="primary">
            <!--About-->
        <div id="site-description">
            <h2>About</h2> <h3><?php echo option('site_title'); ?></h3>    
            <?php echo deco_get_about(); ?>
            
            
            <!--uncomment below to add an RSS feed to homepage or wait until next release
            <h2>External Feed</h2>
            <? //deco_display_rss('http://jeffersonsnewspaper.org/feed/',1);?>
            -->
            
        </div><!--end About-->
	
        <!-- Featured Items slideshow-->
 			<?php echo deco_homepage_gallery();?> 		
 		<!-- end featured items -->
	
        <!-- Featured Exhibit -->
        <div id="featured-exhibits">
            <?php echo deco_exhibit_builder_display_random_featured_exhibit(); ?>
        </div><!-- end featured collection -->
        
    	<!-- Featured Collection -->
    	<div id="featured-collection">    
    		<?php echo deco_display_random_featured_collection();?>
       	</div><!-- end featured collection -->
        

            
    </div><!-- end primary -->
    
    <div id="secondary">

    <!-- Recent Items --> 
        <div id="recent-items">   
        
        
            <h2>Recent Items</h2>
            <?php 
            $deco_get_recent_number=deco_get_recent_number();            
	        set_loop_records('items', get_recent_items($deco_get_recent_number));
	        if (has_loop_records('items')){            
            ?>            
            
            <div class="items-list">
            <?php 
            foreach (loop('Items') as $item): ?>

                <div class="item">

                    <h3><?php echo link_to_item(); ?></h3>

                    <?php if(metadata($item,'has thumbnail')){ ?>
                        <div class="item-img">
                        <?php echo link_to_item(item_image('square_thumbnail',$item)); ?>                        
                        </div>
                    <?php } ?>

                    <?php if($desc = metadata($item,array('Dublin Core', 'Description'), array('snippet'=>190))){ ?>

                        <div class="item-description"><?php echo $desc; ?>
                        <?php echo link_to_item(' ...more',(array('class'=>'show'))) ?>
                        </div>

                    <?php } ?> 

                </div>


            <?php 
            endforeach;
            } ?>
            
            </div>
	
            <p class="view-items-link"><a href="<?php echo html_escape(url('items')); ?>">View All Items</a></p>
            
        </div><!--end recent-items -->
        
    </div><!-- end secondary -->
    
<?php echo foot(); ?>