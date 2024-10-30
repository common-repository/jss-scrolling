<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       www.js-ss.co.uk
 * @since      1.0.0
 *
 * @package    Jss_Scrolling
 * @subpackage Jss_Scrolling/public/partials
 */

global $wpdb;

//$result = $wpdb->get_results( "SELECT * FROM wp_revsize "); /*mulitple row results can be pulled from the database with get_results function and outputs an object which is stored in $result */
global $post;
$postID = $post->ID;
$getpageid = get_the_ID();


$scrollresults = $wpdb->get_results("SELECT * FROM wp_jsss_scrolling WHERE pageid='".$getpageid."' AND rowhidden='1' ");


?>
<meta name="viewport" content="width=device-width, height=device-height,initial-scale=1., maximum-scale=1.0, user-scalable=0">

<script type="text/javascript"> 
jQuery(function ($) { 
$(document).ready(function() {
    $(window).load(function() {

<?php

if (count($scrollresults)> 0){
    if ( is_page($getpageid) ){
?>
var w = window.innerWidth
|| document.documentElement.clientWidth
|| document.body.clientWidth;

var h = window.innerHeight
|| document.documentElement.clientHeight
|| document.body.clientHeight;

var scrollobjarray = 
[

<?php
foreach( $scrollresults as $key => $row ) {
?>
        {objectname: "<?php print($row->objectname) ?>", effect:"<?php print($row->effect) ?>", eventlength:"<?php print($row->eventlength) ?>", pagelocation:"<?php print($row->pagelocation) ?>", lockwith:"<?php print($row->lockwith) ?>"},
<?php
}
?>
]

mtscrollrefresh();

$(window).resize(function(){
mtscrollrefresh();
}); 

$(window).scroll(function(event){
mtscrollrefresh();
});

setTimeout(function () {
  mtscrollrefresh();
}, 1);

function mtscrollrefresh(){
var w = window.innerWidth
|| document.documentElement.clientWidth
|| document.body.clientWidth;

var h = window.innerHeight
|| document.documentElement.clientHeight
|| document.body.clientHeight;

y = $(window).scrollTop();

scrolljss(y, w, h, scrollobjarray);

}

<?php
}
}else{
    ?>
<!--<h1>This is not a scroll plugin page</h1>-->
    <?php
}
?>



    });//loaded
});//ready

});
</script>

