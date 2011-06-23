jQuery.noConflict();
jQuery(document).ready(function() {
jQuery("a.exhibit-item-link,a.download-file").fancybox({
type:'iframe', 
autoDimensions: 'false',
autoScale:'true',
width:'75%',
height:'95%',
overlayOpacity:0.75,
overlayColor:'#000',
titlePosition: 'over',
speedIn:500, 
speedOut:300,
'titleFormat': function(title, currentArray, currentIndex, currentOpts) {
	return '<span id="fancybox-title-over">Item Record</span>';
}
	});
});