<?php
/**
 * The main template file for display portfolio page.
 *
 * Template Name: Gallery Wall
 * @package WordPress
 */

/**
*	Get all photos
**/ 

$menu_sets_query = '';

$portfolio_items = -1;

/**
*	Get Current page object
**/
$page = get_page($post->ID);
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

//Check if password protected
$portfolio_password = get_post_meta($current_page_id, 'portfolio_password', true);
if(!empty($portfolio_password))
{
	session_start();
	
	if(!isset($_SESSION['gallery_page_'.$current_page_id]) OR empty($_SESSION['gallery_page_'.$current_page_id]))
	{
		include (get_template_directory() . "/templates/template-password.php");
		exit;
	}
}

//Get content gallery
$gallery_id = get_post_meta($current_page_id, 'page_gallery_id', true);

//Get global gallery sorting
$pp_orderby = 'menu_order';
$pp_order = 'ASC';
$pp_gallery_sort = get_option('pp_gallery_sort');

if(!empty($pp_gallery_sort))
{
	switch($pp_gallery_sort)
	{
		case 'post_date':
			$pp_orderby = 'post_date';
			$pp_order = 'DESC';
		break;
		
		case 'post_date_old':
			$pp_orderby = 'post_date';
			$pp_order = 'ASC';
		break;
		
		case 'rand':
			$pp_orderby = 'rand';
			$pp_order = 'ASC';
		break;
		
		case 'title':
			$pp_orderby = 'title';
			$pp_order = 'ASC';
		break;
	}
}

$args = array( 
	'post_type' => 'attachment', 
	'numberposts' => -1, 
	'post_status' => null, 
	'post_parent' => $gallery_id,
	'order' => $pp_order,
	'orderby' => $pp_orderby,
); 

//Get gallery images
$all_photo_arr = get_posts( $args );

get_header();
?>

<?php

//Get Page background style
$bg_style = get_post_meta($current_page_id, 'page_bg_style', true);

if($bg_style == 'Static Image')
{
    if(has_post_thumbnail($current_page_id, 'full'))
    {
        $image_id = get_post_thumbnail_id($current_page_id); 
        $image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
        $pp_page_bg = $image_thumb[0];
    }
    else
    {
    	$pp_page_bg = get_stylesheet_directory_uri().'/example/bg.jpg';
    }
    
    wp_enqueue_script("script-static-bg", get_stylesheet_directory_uri()."/templates/script-static-bg.php?bg_url=".$pp_page_bg, false, THEMEVERSION, true);
    
} // end if static image
else
{
    $page_bg_gallery_id = get_post_meta($current_page_id, 'page_bg_gallery_id', true);
    wp_enqueue_script("script-supersized-gallery", get_stylesheet_directory_uri()."/templates/script-supersized-gallery.php?gallery_id=".$page_bg_gallery_id, false, THEMEVERSION, true);
?>

<div id="thumb-tray" class="load-item">
    <div id="thumb-back"></div>
    <div id="thumb-forward"></div>
    <a id="prevslide" class="load-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow_back.png" alt=""/></a>
    <a id="nextslide" class="load-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow_forward.png" alt=""/></a>
</div>

<input type="hidden" id="pp_image_path" name="pp_image_path" value="<?php echo get_stylesheet_directory_uri(); ?>/images/"/>

<?php
}
?>

<!-- Begin content -->
<div id="page_content_wrapper">
    
    <div class="inner">

    	<div class="inner_wrapper">
    	
			<div id="page_caption">
			    <h1 class="cufon"><?php echo $post->post_title; ?></h1>
			</div>
			
			<?php
			    if(!empty($post->post_content))
			    {
			?>
			    <?php echo pp_apply_content($post->post_content); ?><br/><br/>
			<?php
			    }
			?>
    	</div>
    
    </div>
    
</div>

<div id="photo_wall_wrapper">
<?php
    $pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');

    foreach($all_photo_arr as $key => $photo)
    {
    	$small_image_url = get_stylesheet_directory_uri().'/images/000_70.png';
    	$hyperlink_url = get_permalink($photo->ID);
    	$thumb_image_url = '';
    	
    	if(!empty($photo->guid))
    	{
    		$image_url[0] = $photo->guid;
    	    $small_image_url = wp_get_attachment_image_src($photo->ID, 'gallery_wall', true);
    	}
    	
    	$last_class = '';
    	$thumb_image_url = $small_image_url[0];
    	$thumb_width = 336;
    	$thumb_height = 336;
?>

<div class="wall_entry">
    <?php 
    	if(!empty($thumb_image_url))
    	{
    ?>		
    		<a <?php if(!empty($pp_portfolio_enable_slideshow_title)) { ?>data-title="<?php echo $photo->post_title; ?> - <?php echo $photo->post_content; ?>"<?php } ?> class="fancy-gallery" data-fancybox-group="fancybox-thumb" href="<?php echo $image_url[0]; ?>">
    			<img src="<?php echo $thumb_image_url; ?>" alt="" class="portfolio_img"/>
    		</a>
    <?php
    	}		
    ?>

</div>

<?php
    }
?>
</div>

<?php
$page_audio = get_post_meta($current_page_id, 'page_audio', true);

if(!empty($page_audio))
{
?>
<div class="page_audio">
	<?php echo do_shortcode('[audio width="30" height="30" src="'.$page_audio.'"]'); ?>
</div>
<?php
}
?>

<?php get_footer(); ?>