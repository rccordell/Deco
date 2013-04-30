<?php
echo head(array(
    'title' => metadata('exhibit_page', 'title') . ' &middot; ' . metadata('exhibit', 'title'),
    'bodyid' => 'exhibit',
    'bodyclass' => 'show'));
?>
<h1><?php echo link_to_exhibit(); ?></h1>

<nav id="exhibit-pages">
    <?php 
	$exnav = deco_exhibit_builder_nested_nav();
	echo $exnav;    
     ?>
</nav>


<div class="page-content">
<h2><span class="exhibit-page"><?php echo metadata('exhibit_page', 'title'); ?></h2>

<?php exhibit_builder_render_exhibit_page(); ?>

</div>

<div id="exhibit-page-navigation" >

	<?php echo deco_exhibit_builder_pagination_nav();?>

</div>

<?php echo foot(); ?>
