<?php
/*
Plugin Name: Big Blog Map
Plugin URI: http://bigblogmap.com/map/support/
Description: Creates a <strong>new page</strong> which is a map for viewing posts that have been manually geotagged. Activate and check under pages for your brand new blog map! More instructions <a href="http://bigblogmap.com/your-map" target="_blank">here</a>
Author: Ben Jones
Author URI: http://benjaminpeterjones.com/
Version: 1.0.3
*/

/*
 * 
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 51
 * Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * -------------------------------------------
 
 * --------Beyond the Plugin--------
 * If you are interested in adding to the BBM plugin, please contact me first (ben.p.js@gmail.com).
 * If you are looking for something beyond the scope of this plugin, I am available for hire as a 
 * developer.
 * */

add_action('admin_init', 'bbm_options_init' );
add_action('admin_menu', 'bbm_options_add_page');



// Init plugin options to white list our options
function bbm_options_init(){
	register_setting( 'bbm_options_options', 'bbm_options', 'bbm_options_validate' );
}

// Add menu page
function bbm_options_add_page() {
	add_options_page('Big Blog Map Options', 'Big Blog Map', 'manage_options', 'bbm_options', 'bbm_options_do_page');
}


// Draw the menu page itself
function bbm_options_do_page() {
	
	wp_enqueue_media();
	
	?>
	<div class="wrap">
		<h2>Big Blog Map Options</h2>
		<form method="post" action="options.php">
			<?php settings_fields('bbm_options_options'); ?>
			<?php $options = get_option('bbm_options'); ?>
			
			<table class="form-table">
				<tr valign="top"><th scope="row">Logo Url</th>
					<td>
                        <input style="width:330px;" type="text" name="bbm_options[logoUrl]" id="upload_logo" placeholder="" value="<?php echo $options['logoUrl']; ?>" />
                        <input style="width:65px;" class="button upload-media-button" name="upload_logo_button" id="upload_logo_button" value="Upload" />
                    </td>
				</tr>
				
				
				<div class="uploader">
                 
                </div>
				
				
				<tr valign="top"><th scope="row"></th>
					<td>Images are shrunk to a maximum height of 40px.<br/><br/></td>
				</tr>
				<tr valign="top"><th scope="row">Default Icon Url</th>
					<td>		
					<input style="width:330px;" type="text" name="bbm_options[iconUrl]" id="upload_icon" placeholder="" value="<?php echo $options['iconUrl']; ?>" />
                    <input style="width:65px;" class="button upload-media-button" name="upload_icon_button" id="upload_icon_button" value="Upload" />
                    
					
					
					</td>
				</tr>
				<tr valign="top"><th scope="row"></th>
					<td>A great place to get icons is <a target="_blank" href="http://mapicons.nicolasmollet.com/">here</a>.<br/><br/></td>
				</tr>
				<!--<tr valign="top"><th scope="row">Default Cluster Url</th>
					<td><input style="width:400px" type="text" name="bbm_options[clusterUrl]" placeholder="Upload an image via 'media' and copy and paste the URL here" value="<?php echo $options['clusterUrl']; ?>" /></td>
				</tr>-->
				
				
				<tr valign="top"><th scope="row">Welcome Message</th>
					<td><input style="width:400px" type="text" name="bbm_options[welcomeMessage]" value="<?php echo $options['welcomeMessage']; ?>" /></td>
				</tr>
				
				<tr valign="top"><th scope="row"></th>
					<td>Enter HTML or plain text. E.g.<br/><code>&#60;h2&#62;Welcome to my map&#60;&#47;h2&#62;&#60;p&#62;Each marker is a blog. Click on it to read.&#60;&#47;p&#62;</code>. Type <code>blank</code> for no message.<br/><br/></td>
				</tr>
				
				<tr valign="top"><th scope="row">Twitter Handle</th>
					<td><input type="text" placeholder="Enter without the '@'" name="bbm_options[twitterHandle]" value="<?php echo $options['twitterHandle']; ?>" /></td>
				</tr>
				
				

				<tr valign="top"><th scope="row"><br/><br/><br/><br/><h3>Extras</h3></th>
					<td></td>
				</tr>
				
				<tr valign="top"><th scope="row">Show Photo Button</th>
					<td><input type="checkbox" <?php
					if ($options['panoramio'] =='true'){
					echo ' checked="checked"';
					}
					?> name="bbm_options[panoramio]}" value="true" /></td>
				</tr>
				<tr valign="top"><th scope="row">Show Random Button</th>
					<td><input type="checkbox" <?php
					if ($options['random'] =='true'){
					echo ' checked="checked"';
					}
					?> name="bbm_options[random]}" value="true" /></td>
				</tr>
				
				<tr valign="top"><th scope="row">Show Polyline Button</th>
					<td><input type="checkbox" <?php
					if ($options['polyline'] =='true'){
					echo ' checked="checked"';
					}
					?> name="bbm_options[polyline]}" value="true" /></td>
				</tr>
				
				
				<!--<tr valign="top"><th scope="row">Show Category Dropdown</th>
					<td><input type="checkbox" <?php
					if ($options['categoryDropdown'] =='true'){
					echo ' checked="checked"';
					}
					?> name="bbm_options[categoryDropdown]}" value="true" /></td>
				</tr>-->
				
				<!--<tr valign="top"><th scope="row">Show Map Thumbnail after Posts</th>
					<td><input type="checkbox" <?php
					if ($options['mapThumb'] =='true'){
					echo ' checked="checked"';
					}
					?> name="bbm_options[mapThumb]}" value="true" /></td>
				</tr>-->
				
				<tr valign="top"><th scope="row"><strong>Say thanks</strong> by displaying a 'Get a Map' Tab :)</th>
					<td><input type="checkbox" <?php
					if ($options['noAds'] =='true'){
					echo ' checked="checked"';
					}
					?> name="bbm_options[noAds]}" value="true" /></td>
				</tr>
				<br/>
				<tr valign="top"><th scope="row">Open Prompt</th>
					<td><input style="width:400px" type="text" name="bbm_options[openMessage]" value="<?php echo $options['openMessage']; ?>" /></td>
				</tr>
				
				<tr valign="top"><th scope="row"></th>
					<td>Change from the default <code>Click here to open</code>. Use <strong>%here</strong> to replace here e.g. <code>Click %here to check it out</code></td>
				</tr>
				
				
				<tr valign="top"><th scope="row">Multiple Markers Notification</th>
					<td><input style="width:400px" type="text" name="bbm_options[multipleMessage]" value="<?php echo $options['multipleMessage']; ?>" /></td>
				</tr>
				
				<tr valign="top"><th scope="row"></th>
					<td>Message to display when multiple markers are close together. Use <strong>%s</strong> as the number e.g. <code>There are %s restaurants here</code></td>
				</tr>
				
			
				
				
				<tr valign="top"><th scope="row">Open Full Screen or Inline</th>
				<td>
					<select name="bbm_options[iframeDisplay]">
					<option value="fullScreen" 
					<?php
					if ($options['iframeDisplay'] =="fullScreen")
					{
					echo 'selected="selected"';
					}?>
					
					>Full Screen</option>
					<option value="inline"
					<?php
					if ($options['iframeDisplay'] =="inline")
					{
					echo 'selected="selected"';
					}?>
					>Inline</option>
					</select>
					</td>
				</tr>
				
				
				
			</table>
			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
            <input type="submit" class="button-primary" id="hidden-submit" style="
            position: fixed;
            bottom: 30px;
            display: none;
            z-index: 20;
            right: 38px;" value="<?php _e('Save Changes') ?>" />    
		</form>
		
		<p>Full support can be found <a href="http://bigblogmap.com/your-map" target="_blank" title="Big Blog Map Support">here</a>.
		</p>
	</div>
	

	
	
	<script>
jQuery(document).ready(function($){
  var _custom_media = true,
      _orig_send_attachment = wp.media.editor.send.attachment;

  $('.upload-media-button').click(function(e) {
    var send_attachment_bkp = wp.media.editor.send.attachment;
    var button = $(this);
    var id = button.attr('id').replace('_button', '');
    _custom_media = true;
    wp.media.editor.send.attachment = function(props, attachment){
      if ( _custom_media ) {
        $("#"+id).val(attachment.url);
        changeAlert();
      } else {
        return _orig_send_attachment.apply( this, [props, attachment] );
      };
    }

    wp.media.editor.open(button);
    return false;
  });

  $('.add_media').on('click', function(){
    _custom_media = false;
  });
  
  
  
  //Change Alert
  jQuery('input').change(function(){
    changeAlert()
 });
});
	
	
	
	function changeAlert(){
    jQuery('#hidden-submit').css('display','inherit');
    }
	</script>
	
	
	<?php	
}

// Sanitize and validate input. Accepts an array, return a sanitized array.
function bbm_options_validate($input) {
	// Our first value is either 0 or 1
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );
	
	// Say our second option must be safe text with no HTML tags
	$input['sometext'] =  wp_filter_nohtml_kses($input['sometext']);
	
	return $input;
}


function my_template() {

	
	
	if (get_post_meta(get_the_ID(),'bbm_map_page',true)=='true') {
		
		$plugindir = dirname( __FILE__ );
		$template_path = $plugindir . '/theme_files/template_bbm.php';
	
        include ($template_path);
        exit;
    }
}
 
add_action('template_redirect', 'my_template');






function bbm_activate() {

   $bbm_post = array(
  'post_title'    => 'BIG BLOG MAP PAGE',
  'post_type'             => 'page',
  'post_name'             => 'map',
  'post_content'  => 'You look confused.. <ul><li>Add posts to this map by editing any post and clicking on the map on the edit page.</li><li>Change map options like the logo on the menu on the left under Settings -> Big Blog Map</li><li>On this page you can change the permalink</li></ul><p>Help, support and examples <a href="http://bigblogmap.com/your-map#support">here</a></p>',
  'post_status'   => 'publish'
);


$bbm_post_id = wp_insert_post( $bbm_post);

update_post_meta($bbm_post_id,'bbm_map_page','true');

wp_redirect(get_permalink($bbm_post_id));

}
register_activation_hook( __FILE__, 'bbm_activate' );


register_activation_hook(__FILE__, 'my_plugin_activate');
add_action('admin_init', 'my_plugin_redirect');

function my_plugin_activate() {
    add_option('my_plugin_do_activation_redirect', true);
}

function my_plugin_redirect() {
    if (get_option('my_plugin_do_activation_redirect', false)) {
		delete_option('my_plugin_do_activation_redirect' );
		
		$page_url = home_url().'/wp-admin/edit.php?post_type=page';
		$posts_url = home_url().'/wp-admin/edit.php';
		
			echo '<div class="updated">
			   <h2>Dude! You\'ve just created a map page!</h2>
			   <p>Your map page can be founded under <a href="'.$page_url.'" target="_blank" >pages</a>, just like any other page.</p>
			   <p>To add posts to the map, just <a target="_blank" href="'.$posts_url.'">edit any post</a> and choose a location on the map.</p>
			   <p><strong>Add locations to at least 2 posts to get started</strong></p>
			</div>';
    }
}




function add_post_content($content) {
	if(!is_feed() && !is_home()) {

	$options = get_option('bbm_options');
	$mapThumb = $options['mapThumb'];
	
	
	
	
	$latitude = get_post_meta(get_the_ID(),'latitude',true );
	$longitude = get_post_meta(get_the_ID(),'longitude',true );
	
	if ($latitude != "" && $longitude != "" && $mapThumb =="true"){
	
	$key = 'bbm_map_page';
	$value = 'true';
	
		global $wpdb;
		$meta = $wpdb->get_results("SELECT * FROM `".$wpdb->postmeta."` WHERE meta_key='".$wpdb->escape($key)."' AND meta_value='".$wpdb->escape($value)."'");
		if (is_array($meta) && !empty($meta) && isset($meta[0])) {
			$meta = $meta[0];
		}		
		if (is_object($meta)) {
			$map_id =  $meta->post_id;
			$map_permalink =  get_permalink( $map_id );
		}
	
	
	
			$content .= '<div style="width:100%; height: 160px; overflow:hidden;text-align: center;"><a href="'.$map_permalink.'" title="View on a larger map"><img style="
			height: 100%;
			min-width: 640px;
			margin-left: auto;
			margin-right: auto;
		" src="http://maps.googleapis.com/maps/api/staticmap?center='.$latitude.','.$longitude.'&zoom=5&size=1000x150&maptype=roadmap&markers=color:red%7C'.$latitude.','.$longitude.'&sensor=false&visual_refresh=true"></img></a></div>';
			return $content;	
	}
	}
}
//add_filter('the_content', 'add_post_content');










add_action( 'add_meta_boxes', 'bbm_location_meta' );
        function bbm_location_meta() {
                add_meta_box( 'bbm_meta', 'Add Post to the Map', 'bbm_location_url_meta', 'post', 'normal', 'high' );
                }

            function bbm_location_url_meta( $post ) {
			
                $bbm_location_url = get_post_meta( $post->ID, '_bbm_location_url', true);
                $bbm_latitude = get_post_meta( $post->ID, 'bbm_latitude', true);
                $bbm_longitude = get_post_meta( $post->ID, 'bbm_longitude', true);
                $bbm_include = get_post_meta( $post->ID, 'bbm_include', true);
				
					$plugin_directory = plugins_url().'/blog-map/';
					
					$query = new WP_Query( array ('meta_key' => 'bbm_map_page','meta_value' => 'true' ) );
                ?>
					<!--Start of Picker-->
					
					<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
					<script src="<?php echo $plugin_directory;?>/menu-files/js/jquery-gmaps-latlon-picker.js"></script>
					
					<link rel='stylesheet' href='<?php echo $plugin_directory;?>/menu-files/css/jquery-gmaps-latlon-picker.css' type='text/css' media='all' />
					
					<fieldset class="gllpLatlonPicker">
					<input style="width:250px" type="text" class="gllpSearchField" id="gllpSearchField" placeholder="Search for a place or double click the map">
					<input type="button" class="gllpSearchButton button" value="search"><small>   Don't press enter :)</small>
					
					<br/><br/>
					<div class="gllpMap">Google Maps</div>
					<br/>
						<input style="display:none" type="text" name="bbm_latitude" class="gllpLatitude" value="<?php echo $bbm_latitude?>"/>
						<input style="display:none" type="text" name="bbm_longitude" class="gllpLongitude" value="<?php echo $bbm_longitude?>"/>
						<input style="display:none" type="text" class="gllpZoom" value="3"/>
						
					<input type="button" style="display:none" class="gllpUpdateButton" value="update map">
					
					Include this post on the map:  <input id="bbm_include" type="checkbox" <?php
					if ($bbm_include ==true){
					echo ' checked="checked"';
					}
					?> name="bbm_include" value="true" />
					
					
					<br/><br/><span class="float:right;"><a target="_blank" href="http://bigblogmap.com/your-map/#support">Support and Documentation</a></span>
					
					
					<script>
					
					jQuery(document).ready(function(){
					
				
				
				jQuery(document).bind("location_changed", function(event, object) {
					jQuery('#bbm_include').attr('checked','checked');
				});
				
					});
					
					</script>
				</fieldset>
                <?php
        }

add_action( 'save_post', 'bbm_save_project_meta' );
        function bbm_save_project_meta( $post_ID ) {
            global $post;
            if( $post->post_type == "post" ) {
            if (isset( $_POST ) ) {
                update_post_meta( $post_ID, 'bbm_latitude', strip_tags( $_POST['bbm_latitude'] ) );
                update_post_meta( $post_ID, 'bbm_longitude', strip_tags( $_POST['bbm_longitude'] ) );
                update_post_meta( $post_ID, 'bbm_include', strip_tags( $_POST['bbm_include'] ) );
            }
        }
        }
?>
