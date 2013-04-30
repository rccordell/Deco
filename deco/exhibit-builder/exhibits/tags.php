<?php
$title = __('Browse Exhibits by Tag');
echo head(array('title' => $title, 'bodyid' => 'exhibit', 'bodyclass' => 'tags'));
?>
<h1><?php echo $title; ?></h1>

<ul class="items-nav navigation" id="secondary-nav">
    <?php echo nav(array(
            array(
                'label' => __('All'),
                'uri' => url('exhibits/browse')
            ),
            array(
                'label' => __('Tags'),
                'uri' => url('exhibits/tags')
            )
        )
    ); ?>
</ul>

<?php echo tag_cloud($tags, 'exhibits/browse'); ?>

<?php echo foot(); ?>
