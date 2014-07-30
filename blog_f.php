<?php
/**
 * Template Name: Blog Fullwidth
 * The main template file for display blog page.
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

if(!isset($current_page_id) && isset($page->ID))
{
    $current_page_id = $page->ID;
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
$page_style = 'Right Sidebar';
$add_sidebar = TRUE;
$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);

//If not select sidebar then select default one
if(empty($page_sidebar))
{
	$page_sidebar = 'Blog Sidebar';
}

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
<?php $page_menu_style=($page_menu_option=='off' ? 'no-menu' : '');?>
<div id="page_content_wrapper" class="page_content_wrapper no-half <?php echo $page_content_position;?> <?php echo $page_menu_style;?>">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">		
    		<div class="sidebar_content full_width transparentbg">
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
        	       <div id="page_caption">
                        <h1 class="cufon"><?php the_title(); ?></h1>
                    </div>
                    <?php } ?>
					
<?php

global $more; $more = false; 

$query_string ="post_type=post&paged=$paged";
query_posts($query_string);

if (have_posts()) : while (have_posts()) : the_post();

	$image_thumb = '';
								
	if(has_post_thumbnail(get_the_ID(), 'large'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
	}
?>

<!-- Begin each blog post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post_wrapper">
		<!--<div class="post_header">
	    	<h5 class="cufon"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
	    </div>-->
	     <br class="clear"/>
		<?php
	    	if(!empty($image_thumb))
	    	{
	    		$small_image_url = wp_get_attachment_image_src($image_id, 'blog_f', true);
	    ?>
	    
	    <div class="post_img">
	    		<img src="<?php echo $small_image_url[0]; ?>" alt="" class=""/>
	    </div>
	    <br class="clear"/>
	    
	    <?php
	    	}
	    ?>
	
		<div class="post_date">
			<div class="date"><?php the_time('j'); ?></div>
		    <div class="month"><?php the_time('M'); ?></div>
		</div>
	    
	    <div class="post_header">
	    	<div class="post_detail">
	    	<?php echo _e( 'Av', THEMEDOMAIN ); ?> <?php echo get_the_author(); ?> on <?php echo get_the_time('d M Y'); ?> /
	    		<?php comments_number('0 Comment', '1 Comment', '% Comments'); ?>
	    	</div>
	    	<br class="clear"/>
	    	<h5 class="cufon"><?php the_title(); ?></h5>
	    </div>
	    <br class="clear"/><hr/><br class="clear"/>
	    <?php
        //Get social media sharing option
        $pp_blog_social_sharing = get_option('pp_blog_social_sharing');
        
        if(!empty($pp_blog_social_sharing))
        {
            ?>
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
            <a class="addthis_button_preferred_1" addthis:url="<?php the_permalink(); ?>" addthis:title="<?php the_title(); ?>"></a>
            <a class="addthis_button_preferred_2" addthis:url="<?php the_permalink(); ?>" addthis:title="<?php the_title(); ?>"></a>
            <a class="addthis_button_preferred_3" addthis:url="<?php the_permalink(); ?>" addthis:title="<?php the_title(); ?>"></a>
            <a class="addthis_button_preferred_4" addthis:url="<?php the_permalink(); ?>" addthis:title="<?php the_title(); ?>"></a>
            <a class="addthis_button_compact" addthis:url="<?php the_permalink(); ?>" addthis:title="<?php the_title(); ?>"></a>
            <a class="addthis_counter addthis_bubble_style" addthis:url="<?php the_permalink(); ?>" addthis:title="<?php the_title(); ?>"></a>
            </div>
            <script type="text/javascript">
                var addthis_config = addthis_config||{};
                addthis_config.data_track_addressbar = false;
            </script>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ppulpipatnan"></script>
            <!-- AddThis Button END -->
            <br class="clear"/>
            <?php
                }
            ?>
	    <?php
	    	$pp_blog_display_full = get_option('pp_blog_display_full');
	    	
	    	if(!empty($pp_blog_display_full))
	    	{
	    		the_content();
	    	}
	    	else
	    	{
	    		the_excerpt();
	    ?>
	    
	    		<br/><br/>
	    		<a class="button" href="<?php the_permalink(); ?>"><?php echo _e( 'Läs mer', THEMEDOMAIN ); ?> →</a>
	    
	    <?php
	    	}
	    ?>
	    
	</div>

</div>
<!-- End each blog post -->

<?php endwhile; endif; ?>

    	<?php
			if (function_exists("wpapi_pagination")) 
			{
			    wpapi_pagination($wp_query->max_num_pages);
			}
			else
			{
			?>
			    <div class="pagination"><p><?php posts_nav_link(' '); ?></p></div>
			<?php
			}
		?>
    		
    	</div>
    	
    </div>
    <!-- End main content -->

</div>  

<?php get_footer(); ?>