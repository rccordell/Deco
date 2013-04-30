<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
<title><?php echo option('site_title'); echo $title ? ' | ' . $title : ''; ?></title>

<!-- Meta -->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo option('description'); ?>" />

<?php echo auto_discovery_link_tags(); ?>

<!-- Get Core stylesheets -->

<?php 
queue_css_file('screen');
queue_css_file('jquery.fancybox-1.3.4');
queue_css_file('video-js');
queue_css_file('print'); 
echo head_css();
?>

<!-- Get the Configurable stylesheet -->

<link rel="stylesheet" media="screen" href="<?php echo html_escape(css_src(deco_get_stylesheet())); ?>" />

<!-- get fancy fonts via Google Fonts API if the theme is "Wood" -->

<?php if (deco_get_stylesheet()!=='custom'){echo'<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lobster|Cuprum"/>';}
?>


<!-- JavaScripts -->

<?php
queue_js_file(array(
	'fancybox/jquery.easing-1.3.pack',
	'fittext.min',
	'fancybox/jquery.fancybox-1.3.4',
	'video-js/video',
	'swipe.min'
	));
echo head_js();
?>

<!-- Plugin Stuff -->

<?php echo fire_plugin_hook('public_header'); ?>

<!-- this hides the slideshow divs from users who do not have javascript enabled so they don't see a big mess -->
<noscript>
<style>#showcase,.showcase, h2.awkward{display:none; visibility:hidden;}</style>
</noscript>

</head>
<body<?php echo $bodyid ? ' id="'.$bodyid.'"' : ''; ?><?php echo $bodyclass ? ' class="'.$bodyclass.'"' : ''; ?>>
	<div id="wrap">
		
		<div id="primary-nav">
			<ul class="navigation">
				<?php echo public_nav_main(); ?>
			</ul>
			<!-- search --> 
			<div id="search-container">
			    <?php echo bp_simple_search(); ?>
			    <?php echo link_to_item_search('Advanced Search'); ?>
			</div>
		</div><!-- end primary-nav -->
		<div id="header">
		<div id="site-title">
		<h2><?php echo link_to_home_page(); ?></h2>
		<div class="tagline"><?php echo deco_get_tagline();?></div>
		</div>
		</div>

		<div id="content">
		<?php fire_plugin_hook('public_content_top'); ?>