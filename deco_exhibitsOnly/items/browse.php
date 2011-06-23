<?php 
//only logged in users may browse items
$user = Omeka_Context::getInstance()->getCurrentUser();
$authenticated = ('super'||'admin'||'contributor'||'researcher');
if ($user->role == $authenticated):
?>
		
		<?php head(array('title'=>'Browse Items','bodyid'=>'items','bodyclass' => 'browse')); ?>

	<div id="primary">
		
		<h1>Browse Items (<?php echo total_results(); ?> total)</h1>

		<ul class="items-nav navigation" id="secondary-nav">
			<?php echo nav(array('Browse All' => uri('items'), 'Browse by Tag' => uri('items/tags'))); ?>
		</ul>
		
		<div id="pagination-top" class="pagination"><?php echo pagination_links(); ?></div>
		
		<?php while (loop_items()): ?>
			<div class="item hentry">    
				<div class="item-meta">
				    
				<h2><?php echo link_to_item(item('Dublin Core', 'Title'), array('class'=>'permalink')); ?></h2>

				<?php if (item_has_thumbnail()): ?>
    				<div class="item-img">
    				<?php echo link_to_item(item_square_thumbnail(array('class'=>'sq-browse'))); ?>						
    				</div>
				<?php endif; ?>
				
				<?php if ($text = item('Item Type Metadata', 'Text', array('snippet'=>250))): ?>
    				<div class="item-description">
    				<p><?php echo $text; ?></p>
    				</div>
				<?php elseif ($description = item('Dublin Core', 'Description', array('snippet'=>250))): ?>
    				<div class="item-description">
    				<?php echo $description; ?>
    				</div>
				<?php endif; ?>

				<?php if (item_has_tags()): ?>
    				<div class="tags"><p><strong>Tags:</strong>
    				<?php echo item_tags_as_string(); ?></p>
    				</div>
				<?php endif; ?>
				
				<?php echo plugin_append_to_items_browse_each(); ?>

				</div><!-- end class="item-meta" -->
			</div><!-- end class="item hentry" -->
		<?php endwhile; ?>
	
		<div id="pagination-bottom" class="pagination"><?php echo pagination_links(); ?></div>
		
		<?php echo plugin_append_to_items_browse(); ?>
			
	</div><!-- end primary -->
	
<?php foot(); ?>

<?php else:?>

<?php head(array('title'=>'Authentication Required','bodyid'=>'authentication-required','bodyclass'=>'browse')); ?>

<div id="primary">
	
<h2>Authentication Required</h2>
	
	<p>Sorry, you need to be logged in to browse the item archive. <br/>Perhaps you would like to 
	<?php echo '<a href="'.uri('admin').'/">Login</a>'; ?> or <?php echo '<a href="'.uri('exhibits').'/">Browse Exhibits</a>'; ?> instead.</p>

</div><!-- end primary -->

<?php foot(); ?>

<?php endif; ?>