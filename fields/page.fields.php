<?php

/**
 * The PHP code for setup Theme page custom fields.
 *
 * @package WordPress
 * @subpackage Pai
 */


/*
	Begin creating custom fields
*/

$args = array(
    'numberposts' => -1,
    'post_type' => array('gallery'),
);

$galleries_arr = get_posts($args);
$galleries_select = array();
$galleries_select[''] = '';

foreach($galleries_arr as $gallery)
{
	$galleries_select[$gallery->ID] = $gallery->post_title;
}

$theme_sidebar = array(
	'' => '',
	'Page Sidebar' => 'Page Sidebar', 
	'Contact Sidebar' => 'Contact Sidebar', 
	'Blog Sidebar' => 'Blog Sidebar',
);

$menus = array();
$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );

$list_menu = array(
	'' => '',
);

if(is_array($menus)){
	if(!empty($menus)){
		foreach ($menus as $key => $value) {
			$list_menu[$value->name] = $value->name; 
		}
	}
}



$sliders = array();
// Get screen options
	$lsScreenOptions = get_option('ls-screen-options', '0');
	$lsScreenOptions = ($lsScreenOptions == 0) ? array() : $lsScreenOptions;
	$lsScreenOptions = is_array($lsScreenOptions) ? $lsScreenOptions : unserialize($lsScreenOptions);

	// Defaults
	if(!isset($lsScreenOptions['showTooltips'])) { $lsScreenOptions['showTooltips'] = 'true'; }
	if(!isset($lsScreenOptions['showRemovedSliders'])) { $lsScreenOptions['showRemovedSliders'] = 'false'; }
	if(!isset($lsScreenOptions['numberOfSliders'])) { $lsScreenOptions['numberOfSliders'] = '10'; }

	// Get current page
	$curPage = (!empty($_GET['paged']) && is_numeric($_GET['paged'])) ? (int) $_GET['paged'] : 1;
	// $curPage = ($curPage >= $maxPage) ? $maxPage : $curPage;

	// Set filters
	$filters = array('page' => $curPage, 'limit' => (int) $lsScreenOptions['numberOfSliders']);
	if($lsScreenOptions['showRemovedSliders'] == 'true') {
		$filters['exclude'] = array('hidden'); }

	// Find sliders
	if(isset($LSC)){
		$sliders = LS_Sliders::find($filters);
	}
$LS_Sliders = array(
	'' => '',
);

if(!empty($sliders)){
	foreach($sliders as $key => $value){
		$LS_Sliders[$value['id']]=$value['name'];
	}
}


$dynamic_sidebar = get_option('pp_sidebar');

if(!empty($dynamic_sidebar))
{
	foreach($dynamic_sidebar as $sidebar)
	{
		$theme_sidebar[$sidebar] = $sidebar;
	}
}

$page_postmetas = 
	array (
		/*
			Begin Page custom fields
		*/
		array("section" => "Content Position Style", "id" => "page_content_position_style", "type" => "select", "title" => "Content Position Style", "description" => "Select Content Position options for this page", "items" => 
			array(	"up" => "up", 
					"down" => "down", 
				)),
		array("section" => "Background Style", "id" => "page_bg_style", "type" => "select", "title" => "Background Style", "description" => "Select background options for this page", "items" => 
			array(	"Static Image" => "Static Image", 
					"Slideshow" => "Slideshow", 
				)),
		array("section" => "Choose Slider", "id" => "page_slider_id", "type" => "select", "title" => "Choose Slider", "description" => "Select slider type to use as background slider", "items" => 
			array(	"Gallery Slider" => "Gallery Slider", 
					"Layer Slider" => "Layer Slider", 
				)),
		array("section" => "Background Gallery", "id" => "page_bg_gallery_id", "type" => "select", "title" => "Background Gallery", "description" => "If you select \"Slideshow\" as background style. Select a gallery here", "items" => $galleries_select),
		array("section" => "Background LS Gallery", "id" => "page_bg_ls_gallery_id", "type" => "select", "title" => "Background LS Gallery", "description" => "If you select \"Slideshow\" as background style. Select a gallery here", "items" => $LS_Sliders),
		
		array("section" => "Menu", "id" => "page_menu_option_id", "type" => "select", "title" => "Menu", "description" => "ON or OFF Menu", "items" => 
			array(	"off" => "off", 
					"on" => "on", 
				)),
		array("section" => "Select Menu", "id" => "page_menu_id", "type" => "select", "title" => "Select Menu", "description" => "Select this menu for the page", "items" => $list_menu),

		array("section" => "Extra click button On/Off", "id" => "page_ex_option_id", "type" => "select", "title" => "Extra click button On/Off", "description" => "ON or OFF Extra click button", "items" => 
			array(	"off" => "off", 
					"on" => "on", 
				)),
		array("section" => "Youtube Video ID", "id" => "page_youtube_id", "type" => "text", "title" => "Youtube Video ID", "description" => "If you select \"Fullscreen Youtube Video\" page template. Enter Youtube Video ID here ex. 5pEbJpjxbbU"),
		
		array("section" => "Vimeo Video ID", "id" => "page_vimeo_id", "type" => "text", "title" => "Vimeo Video ID", "description" => "If you select \"Fullscreen Vimeo Video\" page template. Enter Vimeo Video ID here ex. 58363796"),
		
		array("section" => "Select Sidebar", "id" => "page_sidebar", "type" => "select", "title" => "Page Sidebar", "description" => "Select this page's sidebar to display", "items" => $theme_sidebar),
		/*
			End Page custom fields
		*/
		
	);
?>
<?php

function page_create_meta_box() {

	global $page_postmetas;
	if ( function_exists('add_meta_box') && isset($page_postmetas) && count($page_postmetas) > 0 ) {  
		add_meta_box( 'page_metabox', 'Page Options', 'page_new_meta_box', 'page', 'normal', 'high' );  
	}

}  

function page_new_meta_box() {
	global $post, $page_postmetas;

	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	echo '<br/>';
	
	$meta_section = '';

	foreach ( $page_postmetas as $postmeta ) {

		$meta_id = $postmeta['id'];
		$meta_title = $postmeta['title'];
		$meta_description = $postmeta['description'];
		$meta_section = $postmeta['section'];
		
		$meta_type = '';
		if(isset($postmeta['type']))
		{
			$meta_type = $postmeta['type'];
		}
		
		echo "<strong>".$meta_title."</strong><hr class='pp_widget_hr'/>";

		echo "<div class='pp_widget_description'>$meta_description</div>";

		if ($meta_type == 'checkbox') {
			$checked = get_post_meta($post->ID, $meta_id, true) == '1' ? "checked" : "";
			echo "<input type='checkbox' name='$meta_id' id='$meta_id' value='1' $checked /></p>";
		}
		else if ($meta_type == 'select') {
			echo "<p><select name='$meta_id' id='$meta_id'>";
			
			if(!empty($postmeta['items']))
			{
				foreach ($postmeta['items'] as $key => $item)
				{
					$page_style = get_post_meta($post->ID, $meta_id);
				
					if(isset($page_style[0]) && $key == $page_style[0])
					{
						$css_string = 'selected';
					}
					else
					{
						$css_string = '';
					}
				
					echo '<option value="'.$key.'" '.$css_string.'>'.$item.'</option>';
				}
			}
			
			echo "</select></p>";
		}
		else if ($meta_type == 'file') { 
		    echo "<p><input type='text' name='$meta_id' id='$meta_id' class='code' value='".get_post_meta($post->ID, $meta_id, true)."' style='width:89%' /><input id='".$meta_id."_button' name='".$meta_id."_button' type='button' value='Upload' class='metabox_upload_btn button' readonly='readonly' rel='".$meta_id."' style='margin:7px 0 0 5px' /></p>";
		}
		else {
			echo "<p><input type='text' name='$meta_id' id='$meta_id' class='code' value='".get_post_meta($post->ID, $meta_id, true)."' style='width:99%' /></p>";
		}
		
		echo '<br/>';
	}
	
	echo '<br/>';

}

function page_save_postdata( $post_id ) {

	global $page_postmetas;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( isset($_POST['myplugin_noncename']) && !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename(__FILE__) )) {
		return $post_id;
	}

	// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

	// Check permissions

	if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
			return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}

	// OK, we're authenticated

	if ( $parent_id = wp_is_post_revision($post_id) )
	{
		$post_id = $parent_id;
	}

	foreach ( $page_postmetas as $postmeta ) {
	
		if (isset($_POST[$postmeta['id']]) && $_POST[$postmeta['id']]) {
			page_update_custom_meta($post_id, $_POST[$postmeta['id']], $postmeta['id']);
		}

		if (isset($_POST[$postmeta['id']]) && $_POST[$postmeta['id']] == "") {
			delete_post_meta($post_id, $postmeta['id']);
		}
	}

}

function page_update_custom_meta($postID, $newvalue, $field_name) {

	if (!get_post_meta($postID, $field_name)) {
		add_post_meta($postID, $field_name, $newvalue);
	} else {
		update_post_meta($postID, $field_name, $newvalue);
	}

}

//init

add_action('admin_menu', 'page_create_meta_box'); 
add_action('save_post', 'page_save_postdata');  

/*
	End creating custom fields
*/

?>
