<?php
$pageTitle = __('Advanced Search');
    echo head(array('title' => $pageTitle,
               'bodyclass' => 'advanced-search',
               'bodyid' => 'advanced-search-page'));
?>

<div id="primary">
	
<h1><?php echo $pageTitle; ?></h1>
	

<?php echo $this->partial('items/search-form.php',
    array('formAttributes' =>
        array('id'=>'advanced-search-form'))); ?>

</div><!-- end primary -->

<?php echo foot(); ?>