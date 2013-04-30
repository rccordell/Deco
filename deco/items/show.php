<?php echo head(array('title' => metadata('Item',array('Dublin Core', 'Title')), 'bodyid'=>'items','bodyclass' => 'show item')); ?>

<h1><?php echo metadata('Item',array('Dublin Core','Title')); ?></h1>

<!-- start FancyBox initialization and configuration -->
<?php echo js_tag('fancybox/fancybox-init-config');?>		

<!-- Video JS init -->
<script type="text/javascript">VideoJS.setupAllWhenReady();</script>


<div id="primary">
	<div id="item-metadata">



<!-- display files -->	
	<div id="item-images">

	<?php
	if (!$item){
	$item=set_loop_records('Files',$item);
	}	
	//variables used to check mime types for VideoJS compatibility, etc.
	
	$img = array('image/jpeg','image/jpg','image/png','image/jpeg','image/gif');
	$videoJS = array('video/mp4','video/mpeg','video/ogg','video/quicktime','video/webm');
	$videoJS_h264 = array('video/mp4','video/mpeg','video/quicktime');
	$videoJS_webM = array('video/webm');
	$videoJS_ogg = array('video/ogg');
	$wma_video = array('audio/wma','audio/x-ms-wma');
	$wmv_video = array('video/avi','video/msvideo','video/x-msvideo','video/x-ms-wmv');
	$audio = array('application/ogg','audio/aac','audio/aiff','audio/midi','audio/mp3','audio/mp4','audio/mpeg','audio/mpeg3','audio/mpegaudio','audio/mpg','audio/ogg','audio/wav','audio/x-mp3','audio/x-mp4','audio/x-mpeg','audio/x-mpeg3','audio/x-midi','audio/x-mpegaudio','audio/x-mpg','audio/x-ogg','audio/x-wav','audio/x-aac','audio/x-aiff','audio/x-midi','audio/x-mp3','audio/x-mp4','audio/x-mpeg','audio/x-mpeg3','audio/x-mpegaudio','audio/x-mpg');
		
	//Images

	
	$index = 0;
	foreach (loop('files', $item->Files) as $file):
	$mime = metadata($file,'MIME Type');
		
		$caption = (metadata($file,array('Dublin Core', 'Title'))) ? metadata($file, array('Dublin Core', 'Title')) : metadata('Item',array('Dublin Core', 'Title'));
		
		// if the file is an image and it's not named media_thumbnail.jpg, proceed...
		if ( ( array_search($mime,$img) !== false ) ){
		// images: the first one uses fullsize
		if (($file->hasThumbnail()&&($index == 0)))
		echo file_markup($file, array('linkToFile'=>true,'imageSize'=>'fullsize','linkAttributes'=>array('rel'=>'fancy_group', 'class'=>'fancyitem','title' => $caption)),array('class' => 'fullsize', 'id' => 'item-image'));
		// images: the rest use the thumbnails
		elseif (($file->hasThumbnail()&&($index !== 0)))
		echo file_markup($file, array('imageSize'=>'square_thumbnail', 'linkToFile'=>true,'linkAttributes'=>array('rel'=>'fancy_group', 'class'=>'fancyitem','title' => $caption)),array('class' => 'square_thumbnail'));
		}	
		$index++;
	
	endforeach;	
	
	//Streaming
	$videoIndex = 1;
	foreach (loop('files', $item->Files) as $file):
	$mime = metadata($file,'MIME Type');
		// VideoJS videos
		if (array_search($mime,$videoJS) !== false)
		{
		echo '<div class="video-js-box">';
		
		echo '<video id="htmlvideo-'.$videoIndex.'" class="video-js" width="100%" controls preload="none" poster="'.img('vid-poster.jpg').'" data-setup="{}">';
			echo '<source src="'.file_display_url($file,'original').'" ';
			
			// getting the video MIME Types
			if (array_search($mime,$videoJS_h264) !== false) echo 'type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\' />';
			elseif (array_search($mime,$videoJS_webM) !== false) echo 'type=\'video/webm; codecs="vp8, vorbis"\' />';
			elseif (array_search($mime,$videoJS_ogg) !== false) echo 'type=\'video/ogg; codecs="theora, vorbis"\' />';
			
			// the Flash fallback
			echo '<object id="flashvideo_'.$videoIndex.'" class="vjs-flash-fallback" scaling="fit" width="500" height="282" type="application/x-shockwave-flash" data="'.url('').'themes/deco/common/flowplayer/flowplayer-3.2.7.swf">';
				echo '<param name="movie" value="'.url('').'themes/deco/common/flowplayer/flowplayer-3.2.7.swf" />';
				echo '<param name="allowfullscreen" value="true" />';
				echo '<param name="flashvars" value=\'config={"playlist":["'.img('vid-poster.jpg').'", {"url": "'.file_display_url($file,'original').'","autoPlay":false,"autoBuffering":true}]}\' />';
				// the static image fallback as last resort
				echo '<img src="'.img('vid-poster.jpg').'" scale="tofit" width="600" height="338" alt="Poster Image" title="No video playback capabilities." />';
			echo '</object>';
		echo '</video>';
		echo deco_video_ResponsifyVideoScript($videoIndex);
		echo '</div></br><br/>';
		$videoIndex++;
		}	
		//wma video uses Omeka default QT player
		elseif
		(array_search($mime,$wma_video) !== false) echo file_markup($file, array('scale'=>'tofit', 'width' => 600, 'height' => 338));
		//wmv video uses Omeka default QT player
		elseif
		(array_search($mime,$wmv_video) !== false) echo file_markup($file, array('scale'=>'tofit', 'width' => 600, 'height' => 338));
		//audio uses Omeka default QT player
		elseif (array_search($mime,$audio) !== false) echo file_markup($file, array('width' => 600, 'height' => 20));
		$index++;	
	endforeach;	
	
	?>			
	<!-- if user has installed Docs Viewer plugin and turned off auto embed, the viewer will be embedded in the main content area (unless this is turned off in Deco theme config)-->
	<?php
		if (
			(get_theme_option('Docs Viewer Placement')=='yes')
			&&( 
				(plugin_is_active('DocsViewer','2.0'))
				&&(get_option('docsviewer_embed_public')==0) 
			)
			) {
		foreach (loop('files', $item->Files) as $file){
			$files[] = $file;	
		}	
		echo $this->docsViewer($files);
		}		
	?>
	</div>
<!-- end display files -->
    	

    	<?php echo all_element_texts($item); ?>
    	
	<!-- all other plugins-->
	<?php fire_plugin_hook('public_items_show', array('item' => $item, 'view'=> $this)); ?>  	
	
	</div><!-- end item-metadata -->


	
</div><!-- end primary -->
<div id="sidebar">	

<!-- download links -->
	<div id="itemfiles" class="element">
	    <h3>File(s)</h3>
		<div class="element-text">
		    <?php 			
			foreach (loop('Files',$item->Files) as $file):
			echo '<div style="clear:both;padding:2px;">
			<a class="download-file" name="files" href="'. file_display_url($file,'original'). '">'.
			$file->original_filename.'</a>
			&nbsp; ('.metadata($file, 'MIME Type').')
			</div>';
			endforeach;			
			?>
		</div>
	</div>
<!-- end download links -->
	
<!-- If the item belongs to a collection, the following creates a link to that collection. -->
	<?php if (metadata($item, 'Collection Name')): ?>
        <div id="collection" class="element">
            <h3>Collection</h3>
            <div class="element-text"><?php echo link_to_collection_for_item(); ?></div>
        </div>
    <?php endif; ?>

<!-- The following prints a list of all tags associated with the item -->
	<?php if (metadata($item,'has tags')): ?>
	<div id="item-tags" class="element">
		<h3>Tags</h3>
		<div class="element-text"><?php echo tag_string('item'); ?></div> 
	</div>
	<?php endif;?>
	
<!-- The following prints a citation for this item. -->
	<div id="item-citation" class="element">
    	<h3>Citation</h3>
    	<div class="element-text"><?php echo metadata('Item','Citation',array('no_escape' => true)); ?></div>
	</div>

</div> <!-- end sidebar-->


<!-- the edit button for logged in superusers and admins -->
<?php if (is_allowed($item, 'edit')){
echo __('<p><a class="edit" href="/admin/items/edit/'.$item->id.'">{Edit Item}</a></p>');
} ?> 
<!-- end edit button -->


	
	
<ul class="item-pagination navigation">
<li id="previous-item" class="previous">
	<?php echo link_to_previous_item_show('Previous Item'); ?>
</li>
<li id="next-item" class="next">
	<?php echo link_to_next_item_show('Next Item'); ?>
</li>
</ul>



<?php echo foot(); ?>