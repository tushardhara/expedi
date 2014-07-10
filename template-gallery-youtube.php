<?php
/**
 * The main template file for display fullscreen youtube video
 *
 * Template Name: Fullscreen Youtube Video
 * @package WordPress
 */
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
		get_template_part("/templates/template-password");
		exit;
	}
}
if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

$page_ex_option = get_post_meta($current_page_id, 'page_ex_option_id', true);

if(empty($page_ex_option))
{
    $page_ex_option = 'off';
}

$page_content_position = get_post_meta($current_page_id, 'page_content_position_style', true);

if(empty($page_content_position))
{
    $page_content_position = 'up';
}

$page_menu_option = get_post_meta($current_page_id, 'page_menu_option_id',true);

if(empty($page_menu_option))
{
    $page_menu_option = 'off';
}

$page_menu_name = get_post_meta($current_page_id, 'page_menu_id',true);

if(empty($page_menu_name))
{
    $page_menu_name = '';
}
$page_slider_id = get_post_meta($current_page_id,'page_slider_id',true);

if(empty($page_slider_id)){
    $page_slider_id = 'Gallery Slider';
}

$page_title_option_id = get_post_meta($current_page_id, 'page_title_option_id',true);

if(empty($page_title_option_id))
{
    $page_title_option_id = 'off';
}
$page_title_visible_option_id = get_post_meta($current_page_id, 'page_title_visible_option_id',true);

if(empty($page_title_visible_option_id))
{
    $page_title_visible_option_id = 'off';
}

$page_videoQuality = get_post_meta($current_page_id, 'page_videoQuality',true);

if(empty($page_videoQuality))
{
    $page_videoQuality = 'default';
}

get_header();

?>
<br class="clear"/>
</div>
<div class="page_control">
    <a class="tubular-play" href="#">
    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_play.png" alt=""/>
    </a>
    <a class="tubular-pause" href="#">
    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_pause.png" alt=""/>
    </a>
    <a id="page_minimize" href="#">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_minus.png" alt=""/>
    </a>
    <a id="page_maximize" href="#">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_plus.png" alt=""/>
    </a>
</div>

<?php

wp_enqueue_script("jquery.tubular.1.0", get_stylesheet_directory_uri()."/js/jquery.tubular.1.0.js", false, THEMEVERSION, true);

//Get content gallery
$page_youtube_id = get_post_meta($current_page_id, 'page_youtube_id', true);
wp_enqueue_script("script-youtube-bg", get_stylesheet_directory_uri()."/templates/script-youtube-bg.php?youtube_id=".$page_youtube_id."&videoQuality=".$page_videoQuality, false, THEMEVERSION, true);

//Setup Google Analyric Code
get_template_part ("google-analytic");
?>

<?php $page_ex_option_style=($page_ex_option=='off' ? 'no-half' : '');?>
<?php $page_menu_style=($page_menu_option=='off' ? 'no-menu' : '');?>
<div id="page_content_wrapper" class="page_content_wrapper <?php echo $page_ex_option_style;?> <?php echo $page_content_position;?> <?php echo $page_menu_style;?>">

    <div class="inner">
    
    <!-- Begin main content -->
    <div class="inner_wrapper">
    
    	
        
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		
        	<?php if($page_ex_option == 'on'){ ?>
                <div class="half-circle <?php echo $page_content_position == 'up' ? 'hide' : 'show' ;?>"><p>Klicka här<br/>för att läsa mer</p></div>
            <?php } ?>
        	<div class="sidebar_content full_width transparentbg">
                   <div class="uparrow <?php echo $pt=($page_title_option_id == 'off' ? '' : 'fixed');?> <?php echo $posi=($page_content_position == 'up' ? 'down' : 'up');?>"></div>
                    <?php if($page_menu_option == 'on') {?>
                        <?php 
                            if($page_menu_name != ''){
                                wp_nav_menu( 
                                    array( 
                                        'menu'            => $page_menu_name,
                                        'container'       => 'nav',
                                        'container_class' => 'page-menu-nav',
                                        'items_wrap'      => '%3$s',
                                    ) 
                                );
                            }
                        ?>
                    <?php } ?>
                   <?php if($page_title_visible_option_id == 'on') { ?> 
        	       <div id="page_caption" class="<?php echo $pt=($page_title_option_id == 'off' ? '' : 'fixed');?>">
                        <h1 class="cufon"><?php the_title(); ?></h1>
                    </div>
                    <?php } ?>
                    <div class="content_read <?php echo $pt=($page_title_option_id == 'off' ? '' : 'fixed');?>">
        			     <?php the_content(); ?>
                    </div>
        			
        	</div>

        <?php endwhile; ?>
    
    </div>
    <!-- End main content -->
</div>
<?php if($page_title_option_id == 'on') { ?>
<script type="text/javascript">
    (function($) {
        $("body").addClass('hide-scroll');
        $(".page_content_wrapper").height( $(window).height() - $(".top_bar").height());
        $(".page_content_wrapper").css("overflow","auto");
    })(jQuery);
</script>
<?php } ?>
<?php get_footer(); ?>
