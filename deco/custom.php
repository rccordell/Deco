<?php
function bp_simple_search($html='',$buttonText = "Search", $formProperties=array('class'=>'simple-search'), $uri = null)
{
    // Always post the 'items/browse' page by default (though can be overridden).
    if (!$uri) {
        $uri = url('items/browse');
    }
    
    $searchQuery = array_key_exists('search', $_GET) ? $_GET['search'] : '';
    $formProperties['action'] = $uri;
    $formProperties['method'] = 'get';
    $html = '<form ' . tag_attributes($formProperties) . '>' . "\n";
    $html .= '<fieldset>' . "\n\n";
    $html .= get_view()->formText('search', $searchQuery, array('name'=>'search','class'=>'textinput','placeholder'=>'Search items'));
    $html .= get_view()->formSubmit('submit_search', $buttonText);
    $html .= '</fieldset>' . "\n\n";
    
    // add hidden fields for the get parameters passed in uri
    $parsedUri = parse_url($uri);
    if (array_key_exists('query', $parsedUri)) {
        parse_str($parsedUri['query'], $getParams);
        foreach($getParams as $getParamName => $getParamValue) {
            $html .= get_view()->formHidden($getParamName, $getParamValue);
        }
    }
    
    $html .= '</form>';
    return $html;
}


function deco_exhibit_builder_nested_nav($exhibitPage = null){
	if (!$exhibitPage) {
	    $exhibitPage = get_current_record('exhibit_page', false);
	}

	$exhibit = $exhibitPage->getExhibit();
	$topPages = $exhibit->getTopPages();
	$currentPage = $exhibitPage->id;
	$addClass=' class="current" ';
	    
	$html = '<ul>';
	foreach($topPages as $page){
	
		$html .= '<li'.__(($page->id == $currentPage) ? $addClass : "").'><a href="'.exhibit_builder_exhibit_uri($exhibit, $page).'">'.$page->title.'</a>';
		
		$children=exhibit_builder_child_pages($page);
		if($children){
			$html .= '<ul>';
			foreach($children as $child){
				$html .= '<li'.__(($child->id == $currentPage) ? $addClass : "").'><a href="'.exhibit_builder_exhibit_uri($exhibit, $child).'">'.$child->title.'</a></li>';
				$grandchildren=exhibit_builder_child_pages($child);
				if($grandchildren){
					$html .= '<ul>';
				foreach($grandchildren as $grandchild){
					$html .= '<li'.__(($grandchild->id == $currentPage) ? $addClass : "").'><a href="'.exhibit_builder_exhibit_uri($exhibit, $grandchild).'">'.$grandchild->title.'</a></li>';
				}
					$html .= '</ul>';
				}
			}
			$html .= '</ul>';
		}
		$html .='</li>';
	}
	$html .= '</ul>';
	
	return $html;
}

/*
** initialize Awkward Gallery on homepage
** AwkwardGallery is jQuery must use HTML that looks like this...
**
** <div id="showcase" class="showcase">
**	<div>
**		<img src="IMAGE.JPG" alt="IMAGE" />
**		<div class="showcase-thumbnail">
**			<img src="IMAGE.JPG" alt="IMAGE" width="140px" />
**			<div class="showcase-thumbnail-caption">THUMB CAPTION</div>
**			<div class="showcase-thumbnail-cover"></div>
**		</div>
**		<div class="showcase-caption">
**			<a href=""><h3>OVERLAY TITLE</h3></a><br/><p>OVERLAY DESCRIPTION</p>
**		</div>
**	</div>
** </div>
*/

function deco_display_awkward_gallery(){
		$items = get_random_featured_items(10);
		if ($items!=null) 
		{
		
		foreach ($items as $item): 
			if (metadata($item, 'has thumbnail')){
				set_current_record('item',$item);
				$file=item_image('fullsize',$item);
				$src = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $file , $matches);
				$first_img = $matches[1][0];

		    	       echo '<div><img src="'.$first_img.'" alt="" title=""/>'; 
		    	       echo '<div class="showcase-caption">';
		    	       echo '<h3>'.link_to($item,$action,metadata($item,array('Dublin Core', 'Title'))).'</h3>';
		    	       echo '<p>'.metadata($item,array('Dublin Core', 'Description'),array('snippet'=>190));
		    	       echo link_to($item,$action,' ...more').'</p></div></div>'; 

			}
		endforeach; 
		}
		else{
        	echo'<div><img src="'.url('').'themes/deco/images/emptyslideshow.png" alt="Oops" /><div class="showcase-caption"><h3>UH OH!</h3><br/><p>There are no featured images right now. You should turn off "Display Slideshow" in the theme settings until you have some.</p></div></div>';
    	}
}

//foreach(loop('items') as $item){
//if (metadata($item, 'has thumbnail') && ($index<$num)):
//
//set_current_record('item',$item);
//$file=item_image('fullsize',$item);
//$src = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $file , $matches);
//$first_img = $matches[1][0];
//
//$html .='<div data-src="';
//$html .= $first_img;
//$html .= '" data-link="'.record_url($item).'" data-easing="easeInOutCubic">';
//$html .='<div class="camera_caption fadeFromBottom"><h4><a href="'.record_url($item).'">'.metadata($item,array('Dublin Core', 'Title')).'</a></h4></div></div>';
//$index++;
//
//endif;
//}
//}


function deco_awkward_gallery(){
		$awkward_gallery_setting=get_theme_option('Featured Image Gallery') ? get_theme_option('Featured Image Gallery') : 'yes';
		if ($awkward_gallery_setting == 'yes'){return deco_display_awkward_gallery();
} else{
	echo '<style>#showcase,.showcase, h2.awkward{display:none; visibility:hidden;}</style>';
}
}

//extends featured exhibit function to include snippet from description and read more link
function deco_exhibit_builder_display_random_featured_exhibit($num=1){
//    if (function_exists('exhibit_builder_random_featured_exhibit')){
//    $html = '<div id="featured-exhibit">';
//    $featuredExhibit = exhibit_builder_random_featured_exhibit();
//    $html .= '<h2>Featured Exhibit</h2>';
//    if ($featuredExhibit) {
//       $html .= '<h3>' . exhibit_builder_link_to_exhibit($featuredExhibit) . '</h3>';
//       $html .= '<p>' . snippet($featuredExhibit->description, 0, 500,exhibit_builder_link_to_exhibit($featuredExhibit, '<br/>...more')) . '</p>';
//
//    } else {
//       $html .= '<p>You have no featured exhibits.</p>';
//    }
//    $html .= '</div>';
//    return $html;
//    } 
  if (function_exists('exhibit_builder_link_to_exhibit')){
		$featuredExhibit=get_records('Exhibit', array('featured'=>true),$num);
		$html ='';
		if ($featuredExhibit){
			
			foreach( $featuredExhibit as $exhibit){
				$html .= '<div class="featured-exhibit">';
				$html .= '<h2>Exhibit</h2>';
				
				$html .= '<h3>' . exhibit_builder_link_to_exhibit($exhibit) . '</h3>';
				
				$snippetlink = '&nbsp;'.exhibit_builder_link_to_exhibit($exhibit,'... Continue Reading.').'';
				$html .= '<p>' . snippet($exhibit->description, 0, 600,$snippetlink) . '</p>';
				
				$html .= '</div>';
			}
		}else{
			$html .= '<p>You have no featured exhibits.</p>';
		}
		return $html;
  } 



} 


/**
 * This function returns the style sheet for the theme. It will use the argument
 * passed to the function first, then the theme_option for Style Sheet, then
 * a default style sheet.
 *
 * @param $styleSheet The name of the style sheet to use. (null by default)
 *
 **/
function deco_get_stylesheet($styleSheet = null)
{    
    if (!$styleSheet) {
        
        $styleSheet = get_theme_option('Style Sheet') ? 
        get_theme_option('Style Sheet') : 
        'greenstripe';
    }
    
    return $styleSheet; 
    
}
/**
 * This function returns the tagline for the theme.  
 *
 **/

function deco_get_tagline($tagline = null)
{    
    if (!$tagline) {
        
        $tagline = get_theme_option('Tagline') ? 
        get_theme_option('Tagline') : 
        'Add a tagline for your site in theme options';
    }
    
    return $tagline; 
    
}
/**
 * This function returns the homepage about text for the theme.  
 *
 **/

function deco_get_about($about = null)
{    
    if (!$about) {
        
        $about = get_theme_option('About') ? 
        get_theme_option('About') : 
        'Add some text about your site in theme options. You can use HTML!';
    }
    
    return $about; 
    
}
/**
 * This function returns the number of recent items to display on the homepage for the theme.  
 *
 **/
function deco_get_recent_number($recentItems = null)
{    
    if (!$recentItems) {
        
        $recentItems = get_theme_option('Recent Items') ? 
        get_theme_option('Recent Items') : 
        '5';
    }
    
    return $recentItems; 
    
}
/**
 * This function returns the theme credits settings, displayed in the footer for the theme.  
 *
 **/

function deco_display_theme_credit(){
		$theme_credit=get_theme_option('Theme Credit');
		$credit_text=' | <a href="https://github.com/ebellempire/Deco" title="Deco theme on Github">Deco theme</a> by <a href="http://erinbell.org" title="ErinBell.org">E. Bell</a>';
		if ($theme_credit == 'yes')return $credit_text;
}
/**
 * This function returns the related exhibit settings for the theme.  
 *
 **/

//defining the function used to show related exhibits in items/show.php (via omeka.org)
//this could be improved to take into account items that are used multiple times in the same exhibit, which right now causes a redundant link
function deco_link_to_related_exhibits($item) {
	require_once "Exhibit.php"; 
	$db = get_db();

	$select = "
	SELECT e.* FROM {$db->prefix}exhibits e
	INNER JOIN {$db->prefix}sections s ON s.exhibit_id = e.id
	INNER JOIN {$db->prefix}section_pages sp on sp.section_id = s.id
	INNER JOIN {$db->prefix}items_section_pages isp ON isp.page_id = sp.id
	WHERE isp.item_id = ?";

	$exhibits = $db->getTable("Exhibit")->fetchObjects($select,array($item));

	if(!empty($exhibits)) {
		echo '<h3>Related Exhibits</h3>';
		echo '<ul>';
		foreach($exhibits as $exhibit) {
			echo '<li>'.exhibit_builder_link_to_exhibit($exhibit).'</li>';
		}
		echo '</ul>';
	}
}
//this is the function that is actually used on items/show...
function deco_display_related_exhibits(){
		$related_exhibits_setting=get_theme_option('Related Exhibits');
		if ($related_exhibits_setting == 'yes')return deco_link_to_related_exhibits(item('ID'));
}

/**
 * This function returns the FancyBox (lightbox) settings for the theme
 * if the user has not turned them off in theme settings
 *
 **/
 
function deco_fancybox(){
		$fancybox_setting=get_theme_option('Fancy Box');
		if ($fancybox_setting == 'yes') echo js('fancybox/fancybox-init-config');
		}


/**
 * This function returns the random featured collection settings for the theme.  
 *
 **/
//this is the function that toggles the Collection Thumbs
function deco_collection_thumbs_number($num=4){
		$collection_thumbs_setting=get_theme_option('Collection Thumbs');
		if ($collection_thumbs_setting == 'yes'){
			
			echo '<div id="index-collection-img">';
    	    $coll=get_current_record('Collections',false)->id;
    	    
    	    $items=get_records('item',array('hasImage'=>true,'collection'=>$coll),$num);
    	    if(count($items)>=$num){
	        set_loop_records('items', $items);
	        if (has_loop_records('items')){
		        foreach (loop('items') as $item){
		        	echo link_to_item(item_image('square_thumbnail'));
		        	}
	        }
	        }
			echo'</div>';
			
		} 
}
		
function deco_random_featured_collection(){
			$collection=get_db()->getTable('Collection')->findRandomFeatured();
	        if ($collection){
	        set_current_record('collection', $collection);
					echo '<h2>Featured Collection</h2>';
					echo '<h3>'.link_to_collection().'</h3>';
					echo '<p>'.metadata($collection,array("Dublin Core","Description"),array('snippet'=>750)).'</p>';
					echo deco_collection_thumbs_number();
			}else{
        		echo'<p><em>There are no featured collections right now. You should turn off "Display Featured Collections" in the theme settings until you have some.</em></p>';
    		}
}

//this is the function that is actually used on homepage...
function deco_display_random_featured_collection(){
		$random_featured_collection_setting=get_theme_option('Random Featured Collection') ? get_theme_option('Random Featured Collection') : 'yes';
		if ($random_featured_collection_setting == 'yes')return deco_random_featured_collection();
}

// this function uses Zend_Feed to fetch and display an RSS or Atom feed
// example usage, to display one post from omeka.org --> echo deco_display_rss('http://omeka.org/feed/',1) 
function deco_display_rss($feedUrl, $num = 3) {
    try {
        $feed = Zend_Feed_Reader::import($feedUrl);
    } catch (Zend_Feed_Exception $e) {
        echo '<p>Feed not available.</p>';
        return;
    }

    $posts = 0;
    foreach ($feed as $entry) {
        if (++$posts > $num) break;
        $title = $entry->getTitle();
        $link = $entry->getLink();
        $description = $entry->getDescription();
        echo "<p class='feed-title'><a href=\"$link\">$title</a></p>"
           . "<p class='feed-content'>$description <a href=\"$link\">...more</a></p>";
    }
}