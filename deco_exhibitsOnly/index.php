<?php head(array('bodyid'=>'home')); ?> 
    <div id="primary">

<!-- Featured Item -->

<!-- this hides the slideshow divs from users who do not have javascript enabled so they don't see a big mess -->
<noscript>
<style type="text/css">#showcase,.showcase, h2.awkward{display:none; visibility:hidden;}</style>
</noscript>

<!-- Start Awkward Gallery load/config -->
<script type="text/javascript">
jQuery.noConflict();
jQuery(document).ready(function()
{
	jQuery("#showcase").awShowcase(
	{
		width:					846,
		height:					300,
		auto:					true,
		interval:				9500,
		continuous:				true,
		loading:				true,
		tooltip_width:			200,
		tooltip_icon_width:		32,
		tooltip_icon_height:	32,
		tooltip_offsetx:		18,
		tooltip_offsety:		0,
		arrows:					false, 
		buttons:				true,
		btn_numbers:			false,
		keybord_keys:			true,
		mousetrace:				false,
		pauseonover:			true,
		transition:				'vslide', /* vslide/hslide/fade */
		transition_speed:		500,
		show_caption:			'show', /* onload/onhover/show */
		thumbnails:				false,
		thumbnails_position:	'outside-last', /* outside-last/outside-first/inside-last/inside-first */
		thumbnails_direction:	'horizontal', /* vertical/horizontal */
		thumbnails_slidex:		0 /* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
	});
});
</script>
<!-- end Awkward Gallery load/config -->

	
        <!-- Featured Items aka Awkward Showcase image gallery/slideshow-->
 		<div id="showcase" class="showcase">
 		<?php deco_display_exhibit_gallery();?>
 		</div><!-- end featured items -->

            <!--About-->
        <div id="site-description">
            <h2>About</h2>    
            <?php echo deco_get_about(); ?>
            
            
            <!--uncomment below to add an RSS feed to homepage or wait until next release
            <h2>External Feed</h2>
            <? //deco_display_rss('http://jeffersonsnewspaper.org/feed/',1);?>
            -->
            
        </div><!--end About-->
        
	
        <!-- Recent Exhibits -->
            <?php echo deco_exhibit_builder_display_recent_exhibit(); ?>
            
        <!-- testing -->
        <!-- end test -->
            
    </div><!-- end primary -->
    
    
<?php foot(); ?>