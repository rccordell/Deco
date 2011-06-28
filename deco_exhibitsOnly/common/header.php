<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Use Google font, Rokkitt, for non-Windows users-->
<?php if (strpos($_SERVER['HTTP_USER_AGENT'], "Windows", 0) === FALSE) { ?>
<link href='http://fonts.googleapis.com/css?family=Rokkitt' rel='stylesheet' type='text/css'>
<?php } ?>
<!-- end font -->
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
<!-- Get the Custom stylesheet -->
<link rel="stylesheet" media="screen" href="<?php echo html_escape(css(deco_get_stylesheet())); ?>" />


<!-- JavaScripts -->
<?php echo js('default'); ?>

<!-- start Conditional JS -->

<!-- the following scripts only load on the homepage and items pages due to potential plugin conflicts (incl. current version of MyOmeka).  If you would like to use the slideshow or fancybox on another page, add the bodyid for each page below, separated by the or operator (||) -->
	<?php if ($bodyid==("home"||"items")){
	echo js('fancybox/jquery.fancybox-1.3.4');
	echo js('fancybox/jquery.easing-1.3.pack');
	echo js('video-js/video');
	echo js('jquery.aw-showcase');
	}?>
	
<!-- load tootltip script for exhibit items -->

	<?php if ($bodyid==("exhibit")){
	//echo js('jquery.tools.min')
	echo '<script src="http://cdn.jquerytools.org/1.2.5/jquery.tools.min.js"></script>';
	echo js('tooltip-init');
	}?>


<!-- end Conditional JS -->

<!-- Plugin Stuff -->
<?php echo plugin_header(); ?>

</head>
<body<?php echo $bodyid ? ' id="'.$bodyid.'"' : ''; ?><?php echo $bodyclass ? ' class="'.$bodyclass.'"' : ''; ?>>
	<div id="wrap">
			<div id="primary-nav">
			<ul class="navigation">
			<?php echo public_nav_main(array('Home'=>uri(''))); ?>
			</ul>

		</div><!-- end primary-nav -->
		
	<div id="header-login"><?php echo simple_search(); ?> <span><?php echo link_to_advanced_search(); ?> | <?php echo deco_login_or_admin();?></span></div>
		
		<div id="header">
		<div id="site-title">
		<h2><?php echo link_to_home_page(); ?></h2>
		<div class="tagline"><?php echo deco_get_tagline();?></div>
		</div>
		</div>

		<div id="content">