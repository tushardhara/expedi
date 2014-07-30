<?php
/**
 * Template Name: Page with Sidebar
 * The main template file for display page.
 *
 * @package WordPress
*/


/**
*	Get Current page object
**/
$page = get_page($post->ID);


/**
*	Get current page id
**/
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

$page_style = 'Right Sidebar';
$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);

if(empty($page_sidebar))
{
	$page_sidebar = 'Page Sidebar';
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

$add_sidebar = TRUE;
$page_class = 'sidebar_content';


$page_title_visible_option_id = get_post_meta($current_page_id, 'page_title_visible_option_id',true);

if(empty($page_title_visible_option_id))
{
    $page_title_visible_option_id = 'off';
}
get_header(); 
?>

<br class="clear"/>
</div>

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
        $page_bg_ls_gallery_id = get_post_meta($current_page_id, 'page_bg_ls_gallery_id', true);
        if(function_exists ('layerslider')){layerslider($page_bg_ls_gallery_id);}
}
?>

<!-- Begin content -->
<?php
if($bg_style == 'Static Image')
{
?>
<div class="page_control_static">
    <a id="page_minimize" href="#">
    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_zoom.png" alt=""/>
    </a>
    <a id="page_maximize" href="#">
    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_plus.png" alt=""/>
    </a>
</div>
<?php
}
else
{
?>
<div class="page_control">
    <a id="page_minimize" href="#">
    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_minus.png" alt=""/>
    </a>
    <a id="page_maximize" href="#">
    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_plus.png" alt=""/>
    </a>
</div>
<?php
}
?>

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

<!-- Begin content -->
<?php $page_menu_style=($page_menu_option=='off' ? 'no-menu' : '');?>
<div id="page_content_wrapper" class="page_content_wrapper no-half <?php echo $page_content_position;?> <?php echo $page_menu_style;?>">

    <div class="inner">
    
    <!-- Begin main content -->
    <div class="inner_wrapper">
        <div class="sidebar_content full_width transparentbg">
        
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		
        	 <div class="uparrow <?php echo $posi=($page_content_position == 'up' ? 'down' : 'up');?>"></div>
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
                            echo "<div class='clear'></div>";
                        }
                    ?>
                <?php } ?>
             <?php if($page_title_visible_option_id == 'on') { ?> 
                   <div id="page_caption" >
                        <h1 class="cufon"><?php the_title(); ?></h1>
                    </div>
            <?php } ?>
        	<div class="sidebar_content <?php echo $page_class; ?>">
        	
        			<?php the_content(); ?>
        			
        	</div>

        <?php endwhile; ?>
        
        <?php
        	if($add_sidebar)
        	{
        ?>
        	<div class="sidebar_wrapper">
        		<div class="sidebar">
        		
        			<div class="content">
        		
        				<ul class="sidebar_widget">
        				<?php dynamic_sidebar($page_sidebar); ?>
        				</ul>
        			
        			</div>
        	
        		</div>
        		<br class="clear"/>
        
        		<div class="sidebar_bottom"></div>
        	</div>
        <?php
        	}
        ?>
    
        </div>
    
    </div>
    <!-- End main content -->
</div>

<?php get_footer(); ?>
