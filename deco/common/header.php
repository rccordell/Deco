<!DOCTYPE html>
<html>
<head>
<title><?php echo settings('site_title'); echo $title ? ' | ' . $title : ''; ?></title>

<!-- Meta -->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo settings('description'); ?>" />

<?php echo auto_discovery_link_tag(); ?>

<!-- Get Core stylesheets -->

<?php echo queue_css('screen');
queue_css('jquery.fancybox-1.3.4');
queue_css('video-js');
queue_css('print'); 
display_css();
?>

<!-- Get the Configurable stylesheet -->

<link rel="stylesheet" media="screen" href="<?php echo html_escape(css(deco_get_stylesheet())); ?>" />

<!-- get fancy fonts via Google Fonts API if the theme is "Wood" -->

<?php if (deco_get_stylesheet()!=='custom'){echo'<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lobster|Cuprum"/>';}
?>


<!-- JavaScripts -->

<?php

/**
 * Start Conditional JS
 *
 * The following scripts only load on the homepage and items pages due to
 * potential plugin conflicts (incl. current version of MyOmeka).  If you would
 * like to use the slideshow or fancybox on another page, add the bodyid for
 * each page below, separated by the or operator (||).
 */
if ($bodyid==("home"||"items")){

    queue_js(
        array(
            'fancybox/jquery.fancybox-1.3.4',
            'fancybox/jquery.easing-1.3.pack',
            'video-js/video',
            'jquery.aw-showcase'
        )
    );

}

display_js();
?>

<!-- Plugin Stuff -->

<?php echo plugin_header(); ?>

<!-- this hides the slideshow divs from users who do not have javascript enabled so they don't see a big mess -->
<noscript>
<style>#showcase,.showcase, h2.awkward{display:none; visibility:hidden;}</style>
</noscript>

</head>
<body<?php echo $bodyid ? ' id="'.$bodyid.'"' : ''; ?><?php echo $bodyclass ? ' class="'.$bodyclass.'"' : ''; ?>>
	<div id="wrap">
		
		<div id="primary-nav">
			<ul class="navigation">
				<?php echo deco_custom_navigation(); ?>
			</ul>
			<!-- search --> 
			<div id="search-container">
			    <?php echo simple_search(); ?>
			    <?php echo link_to_advanced_search(); ?>
			</div>
		</div><!-- end primary-nav -->
		<div id="header">
		<div id="site-title">
		<h2><?php echo link_to_home_page(); ?></h2>
		<div class="tagline"><?php echo deco_get_tagline();?></div>
		</div>
		</div>

		<div id="content">
