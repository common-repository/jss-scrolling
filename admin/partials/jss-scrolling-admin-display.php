<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       www.js-ss.co.uk
 * @since      1.0.0
 *
 * @package    Jss_Scrolling
 * @subpackage Jss_Scrolling/admin/partials
 */

global $wpdb;
global $rowcount;

/* wpdb class should not be called directly.global $wpdb variable is an instantiation of the class already set up to talk to the WordPress database */ 

$result = $wpdb->get_results( "SELECT * FROM wp_jsss_scrolling "); /*mulitple row results can be pulled from the database with get_results function and outputs an object which is stored in $result */

 $last = $wpdb->get_row("SHOW TABLE STATUS LIKE 'wp_jsss_scrolling'");
        $lastid = $last->Auto_increment;

//$getlastid = $wpdb->query("SELECT Auto_increment FROM information_schema.tables WHERE table_name='wp_revsize'")


//echo "<pre>"; print_r($lastid); echo "</pre>";
/* If you require you may print and view the contents of $result object */
add_action( 'admin_post_nopriv_add_admin_post_scrolljss', 'prefix_admin_add_admin_post_scrolljss' );

?>
<div class="pagetitles">
<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
<h3>Type : Scrolling Animation</h3>
</div>

<form method="post" name="add_admin_post_scrolljss" action="<?php echo admin_url() . 'admin-post.php' ?>" class="pluginform">
<input type="hidden" name="action" value="add_admin_post_scrolljss"/>
<div id="accordion" class="accordioncss">
<?php
$results = $wpdb->get_results("SELECT DISTINCT pageid FROM wp_jsss_scrolling ORDER BY pageid DESC");
/*print_r($results);*/

$pagetitlelist = [];

$args = array(
    'post_type' => 'page',
);

$page_list = get_posts( $args );
foreach($page_list as $singlepage)
 {
$pagetitlelist[] = $singlepage->post_title;
 }
//print_r(get_posts( $args ));

//$results = $wpdb->get_results("SELECT * FROM wp_revsize WHERE pagename='".$getpageid."' ");
foreach($results as $rows)
 {
$resultns = $wpdb->get_results("SELECT * FROM wp_jsss_scrolling WHERE pageid='".$rows->pageid."' ");
$pagetitle = get_the_title($rows->pageid);
?>


  <div class="group wppostbox">
    <h3 class="hndle ui-sortable-handle titleheaders" data-titlehead="<?php print('pageid'.$rows->pageid)?>"><?php print($pagetitle)?>&#58;</h3>                  
    <div>
<input type="hidden" name="hiddentitle" value="<?php print($pagetitle)?>" />
<div class="tblcontainer">
    <p class="pagetitleedit">Page&#58;<span class="pagetitlee" data-titlen="<?php print('pageid'.$rows->pageid)?>"><?php print($pagetitle)?></span>
    <select name="newnames" class="hiddennames" data-titlelist="<?php print('pageid'.$rows->pageid)?>">
    <?php 
      foreach($pagetitlelist as $singlepaget){
        $pagelists = get_page_by_title($singlepaget);
        $pageids =  $pagelists->ID;
    ?>
      <option value="<?php print($pageids)?>"><?php print($singlepaget)?></option>
    <?php
      } 
    ?>
    </select> 
    <span class="genericon genericon-edit" onclick="edittitle(this)" data-titleedit="<?php print('pageid'.$rows->pageid)?>"></span>
</p>

 <table id="revsizetbl">

      <tr>
      <td>
        <h3>Visable</h3>
      </td>
        <td>
          <h3>Object Name</h3>
        </td>
        <td>
          <h3>Effect</h3>
        </td>
        <td>
          <h3>Event Length</h3>
        </td>
        <td>
          <h3>Page Location</h3>
        </td>
        <td>
          <h3>Lock With</h3>
        </td>
        <td>          
            <span class="genericon genericon-checkmark"></span>
        </td>
        <td>
            <span class="genericon genericon-trash"></span>  
        </td>
        <td>
        <div class="menuitem">
            <span class="genericon genericon-key menuitem"></span>
            <span class="menuitem">&#8260;</span>
            <span class="genericon genericon-lock menuitem"></span>
        </div>
        </td>

      </tr>

<?php
$rowcount = array();
foreach($resultns as $row)
 {


array_push($rowcount,$row->id);

 
 /* Print the contents of $result looping through each row returned in the result */
if($row->lockstatus == 'locked'){
$lockstatus = $row->lockstatus;
}else{
$lockstatus = '';
}


?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
      <tr id="<?php print('trow'.$row->id)?>" data-tablerow="<?php print('srow'.$row->id)?>">
          <td>
            <?php 
            if($row->rowhidden == '0'){
            ?>
                <span class="genericon genericon-hide" data-btnhrow="<?php print('row'.$row->id)?>" onclick="hiddenshow(this)"></span>
            <?php
              }else{
            ?>
                <span class="genericon genericon-show eyevisable" data-btnhrow="<?php print('row'.$row->id)?>" onclick="hiddenshow(this)"></span>
            <?php    } ?>

            <!--<input type="hidden" name="<?php print('sg'.$row->id)?>" data-hidebtnrow="<?php print('row'.$row->id)?>" value="<?php print($row->rowhidden) ?>">-->
          </td> 
          <td>
            <input type="hidden" name="identityarray[<?php print($row->id)?>]" value="<?php print($row->id)?>">
            <p id="<?php print('sa'.$row->id)?>" class="tblelement <?php print($lockstatus) ?>" data-row="<?php print('srow'.$row->id)?>" onclick="change(this)"><?php print($row->objectname) ?></p>
            <!--<input type="hidden" name="<?php print('sa'.$row->id)?>" class="hiddenfield <?php print('sa'.$row->id)?>" data-rowinput="<?php print('srow'.$row->id)?>" value="<?php print($row->objectname) ?>" />-->
            <!--<input type="hidden" name="<?php print('sp'.$row->id)?>" class="hiddenfield <?php print('sp'.$row->id)?>" data-pageid="<?php print('pageid'.$rows->pageid)?>" value="<?php print($rows->pageid)?>"  />-->
          
          </td>
          <td>
            <p id="<?php print('sb'.$row->id)?>" class="tblelement <?php print($lockstatus) ?>" data-row="<?php print('srow'.$row->id)?>" onclick="change(this)"><?php print($row->effect) ?></p>
            <!--<input type="hidden" name="<?php print('sb'.$row->id)?>" class="hiddenfield <?php print('sb'.$row->id)?>" data-rowinput="<?php print('srow'.$row->id)?>" value="<?php print($row->effect) ?>" />-->
          </td>
          <td>
            <p id="<?php print('sc'.$row->id)?>" class="tblelement <?php print($lockstatus) ?>" data-row="<?php print('srow'.$row->id)?>" onclick="change(this)"><?php print($row->eventlength) ?></p>
            <!--<input type="hidden" name="<?php print('sc'.$row->id)?>" class="hiddenfield <?php print('sc'.$row->id)?>" data-rowinput="<?php print('srow'.$row->id)?>" value="<?php print($row->eventlength) ?>" />-->
          </td>
          <td>
            <p id="<?php print('sd'.$row->id)?>" class="tblelement <?php print($lockstatus) ?>" data-row="<?php print('srow'.$row->id)?>" data-sizefield="<?php print($row->id)?>" onclick="change(this)"><?php print($row->pagelocation) ?></p>
            <!--<input type="hidden" name="<?php print('sd'.$row->id)?>" class="hiddenfield <?php print('sd'.$row->id)?>" data-rowinput="<?php print('srow'.$row->id)?>" value="<?php print($row->pagelocation) ?>" />-->
          </td>
          <td>
            <p id="<?php print('se'.$row->id)?>" class="tblelement <?php print($lockstatus) ?>" data-row="<?php print('srow'.$row->id)?>" onclick="change(this)"><?php print($row->lockwith) ?></p>
            <!--<input type="hidden" name="<?php print('se'.$row->id)?>" class="hiddenfield <?php print('se'.$row->id)?>" data-rowinput="<?php print('srow'.$row->id)?>" value="<?php print($row->lockwith) ?>" />-->
          </td>
          <td>          
            <span class="genericon genericon-checkmark editoff" data-editrow="<?php print('srow'.$row->id)?>" data-row="<?php print('srow'.$row->id)?>" onclick="revert(this)"></span>
          </td>
          <td>
            <span class="genericon genericon-trash <?php print('bin'.$row->lockstatus) ?>" data-binbtnrow="<?php print('srow'.$row->id)?>" onclick="deleterow(this)"></span>
          </td>   
          <td>

            <?php 
            if($row->lockstatus == 'locked'){
            ?>
                <span class="genericon genericon-lock <?php print($row->lockstatus) ?>" data-btnrow="<?php print('srow'.$row->id)?>" onclick="lockunlock(this)"></span>
            <?php
              }else{
            ?>
                <span class="genericon genericon-key <?php print($row->lockstatus) ?>" data-btnrow="<?php print('srow'.$row->id)?>" onclick="lockunlock(this)"></span>
            <?php    } ?>

            <input id="<?php print('fullrow'.$row->id)?>" type="hidden" name="<?php print('fulldata'.$row->id)?>" data-screensize="<?php print('sd'.$row->id)?>" data-pageid="<?php print('pageid'.$rows->pageid)?>" data-fulldata="<?php print('fulldata'.$row->id)?>" class="hiddenfield" data-rowinput="<?php print('srow'.$row->id)?>" value='{"id":"<?php print($row->id) ?>","rowhidden": "<?php print($row->rowhidden) ?>","pageid": "<?php print($row->pageid) ?>","objectname": "<?php print($row->objectname) ?>", "effect":"<?php print($row->effect) ?>", "eventlength": "<?php print($row->eventlength) ?>", "pagelocation" : "<?php print($row->pagelocation) ?>", "pagelocationm" : "<?php print($row->pagelocationm) ?>", "pagelocations" : "<?php print($row->pagelocations) ?>", "lockwith" : "<?php print($row->lockwith) ?>", "lockstatus": "<?php print($row->lockstatus) ?>"}' />
   
        </td>   
        
      </tr>

  <?php 

  } //end data loop

  ?>

  </table>

        <!--<input id="rowcount" name="rowcount[]" type="hidden" value="<?php //print_r($rowcount) ?>">-->
        <!--<input type="button" class="button button-primary" value="Add row" name="add_admin_row" id="add_admin_row" onclick="addline(<?php //print($lastid)?>)" />-->

        <!--<input type="submit" class="button button-primary" value="Update" name="add_admin_post_scrolljss_submit" id="add_admin_post_scrolljss_submit"/>-->


<?php

  //submit_button('Save all changes', 'primary','submit', TRUE);

  ?>


</div>
    </div>
  </div>

<?php
}
  wp_nonce_field('add_admin_post_scrolljss', 'add_admin_post_nonce');
?>

<!--  <div class="group postbox">
    <h3 class="hndle ui-sortable-handle">Section 2</h3>
    <div>
      <p>Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In suscipit faucibus urna. </p>
    </div>
  </div>-->
</div>
            <div class="bottombar">
            <div class="responcivebar">
              <span class="button button-primary genericon genericon-phone" onclick="activemob()"></span>
              <span class="button button-primary genericon genericon-tablet" onclick="activetablet()"></span>
              <span class="button button-primary genericon genericon-fullscreen" onclick="activefull()"></span>

            </div>
            <table>
            <tr>
              <td colspan="4">
                  <h2>Add Rows To Table</h2>
              </td>
            </tr>
            <tr>
              <td>
                  <h2>Name Of Page&#58;</h2>
              </td>
              <td>
                  <select name="pagenames">
                      <?php 
                        foreach($pagetitlelist as $singlepaget){
                      ?>
                            <option value="<?php print($singlepaget)?>"><?php print($singlepaget)?></option>
                      <?php
                        } 
                      ?>
                  </select> 
              </td>
              <td>
                  <h2>Number Of Rows&#58;</h2>
              </td>
              <td>
                  <select name="addrowval">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                  </select> 

                 <!-- <p id="addrowsnumber" class="tblelement" data-row="addrowsnumber" onclick="change(this)">1</p>
                  <input type="hidden" name="addrowval" class="hiddenfield addrowsnumber" data-rowinput="addrowsnumber" value="1" />
            -->  </td><!--TYPE="number" -->
              <td>
                  <span class="genericon genericon-checkmark editoff" data-editrow="addrowsnumber" onclick="revert(this)"></span>
              </td>
              <td> 
                  <input type="submit" class="button button-primary" value="Add row" name="add_admin_post_scrolljss_submit" id="add_admin_post_add" />
              </td>
              <td>
               <input type="submit" class="button button-primary fixedsave" value="Save all changes" name="add_admin_post_scrolljss_submit" id="add_admin_post_scrolljss_submit"/>
              </td>
            </tr>
            </table>
            </div>



</form>
