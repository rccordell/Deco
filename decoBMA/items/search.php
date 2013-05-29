<?php
$pageTitle = __('Advanced Search');
    echo head(array('title' => $pageTitle,
               'bodyclass' => 'advanced-search',
               'bodyid' => 'advanced-search-page'));
?>

<div id="primary">
	
<h1><?php echo $pageTitle; ?></h1>

	<div class="navigation search" id="secondary-nav">
		<?php echo deco_nav();?>
	</div>
	

<?php echo $this->partial('items/search-form.php',
    array('formAttributes' =>
        array('id'=>'advanced-search-form'))); ?>

</div><!-- end primary -->

<?php echo foot(); ?>