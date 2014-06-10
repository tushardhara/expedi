</div>

<div id="imageFlow">
	<div class="text">
		<div class="title">Loading</div>
		<div class="legend">Please wait...</div>
	</div>
</div>

<div id="fancy_gallery" style="display:none">
<?php
//Check if enable image title
$pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');

//Get homepage gallery images
$pp_homepage_slideshow_cat = get_option('pp_homepage_slideshow_cat');

//Get gallery images
$args = array( 
    'post_type' => 'attachment', 
    'numberposts' => -1, 
    'post_status' => null, 
    'post_parent' => $pp_homepage_slideshow_cat,
    'order' => 'ASC',
	'orderby' => 'menu_order',
); 
$all_photo_arr = get_posts( $args );
$count_photo = count($all_photo_arr); 

foreach($all_photo_arr as $key => $photo)
{
	$full_image_url = wp_get_attachment_image_src( $photo->ID, 'full' );
	$small_image_url = wp_get_attachment_image_src( $photo->ID, 'large' );
?>
<a id="fancy_gallery<?php echo $key; ?>" href="<?php echo $full_image_url[0]; ?>" class="fancy-gallery" rel="fancybox-thumb" <?php if(!empty($pp_portfolio_enable_slideshow_title)) { ?> title="<?php echo $photo->post_title; ?>" <?php } ?>></a>
<?php
}
?>
</div>

<input type="hidden" id="pp_image_path" name="pp_image_path" value="<?php echo get_stylesheet_directory_uri(); ?>/images/"/>
<?php
	$pp_enable_reflection = get_option('pp_enable_reflection');
?>
<input type="hidden" id="pp_enable_reflection" name="pp_enable_reflection" value="<?php echo $pp_enable_reflection; ?>"/>

<?php
$pp_homepage_music_mp3 = get_option('pp_homepage_music_mp3');

if(!empty($pp_homepage_music_mp3))
{
?>
<div class="page_audio">
	<?php echo do_shortcode('[audio width="120" height="30" src="'.$pp_homepage_music_mp3.'"]'); ?>
</div>
<?php
}
?>