<?php
/**
 * The main template file for display tag page.
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

get_header();

//Get Page background style
$pp_blog_bg = get_option('pp_blog_bg'); 
$pp_blog_up_down_layout = get_option('pp_blog_up_down_layout');
$pp_blog_ex_button_layout = get_option('pp_blog_ex_button_layout');
if(empty($pp_blog_bg))
{
    $pp_blog_bg = get_stylesheet_directory_uri().'/example/bg.jpg';
}
if(empty($pp_blog_up_down_layout)){
	$pp_blog_up_down_layout = 'up';
}
if(empty($pp_blog_ex_button_layout)){
	$pp_blog_ex_button_layout = 'off';
}

wp_enqueue_script("script-static-bg", get_stylesheet_directory_uri()."/templates/script-static-bg.php?bg_url=".$pp_blog_bg, false, THEMEVERSION, true);
?>

<!-- Begin content -->
<br class="clear"/>
</div>
<div class="page_control">
    <a id="page_minimize" href="#">
    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_minus.png" alt=""/>
    </a>
    <a id="page_maximize" href="#">
    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_plus.png" alt=""/>
    </a>
</div>
<?php $pp_blog_ex_button_style=($pp_blog_ex_button_layout=='off' ? 'no-half' : '');?>
<div id="page_content_wrapper" class="page_content_wrapper <?php echo $pp_blog_ex_button_style;?> <?php echo $pp_blog_up_down_layout;?> <?php echo 'no-menu';?>">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    	
    		
			<?php if($pp_blog_ex_button_layout == 'on'){ ?>
                <div class="half-circle <?php echo $pp_blog_up_down_layout == 'up' ? 'hide' : 'show' ;?>"><p>Klicka här<br/>för att läsa mer</p></div>
            <?php } ?>
    		<div class="sidebar_content full_width transparentbg">
    			<div class="uparrow <?php echo $posi=($pp_blog_up_down_layout == 'up' ? 'down' : 'up');?>"></div>
    			<div id="page_caption">
	    			<h1 class="cufon"><?php printf( __( ' %s', '' ), '' . single_cat_title( '', false ) . '' ); ?></h1>
	    		</div>
    			<div class="sidebar_content">
					
<?php

global $more; $more = false; # some wordpress wtf logic

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
	
		<?php
	    	if(!empty($image_thumb))
	    	{
	    		$small_image_url = wp_get_attachment_image_src($image_id, 'blog', true);
	    ?>
	    
	    <div class="post_img">
	    	<a href="<?php the_permalink(); ?>">
	    		<img src="<?php echo $small_image_url[0]; ?>" alt="" class=""/>
	    	</a>
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
	    	<?php echo _e( 'Posted by', THEMEDOMAIN ); ?> <?php echo get_the_author(); ?> on <?php echo get_the_time('d M Y'); ?> /
	    		<a href="<?php the_permalink(); ?>"><?php comments_number('0 Comment', '1 Comment', '% Comments'); ?></a>
	    	</div>
	    	<br class="clear"/>
	    	<h5 class="cufon"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
	    </div>
	    <hr/><br class="clear"/>
	    
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
	    		<a class="button" href="<?php the_permalink(); ?>"><?php echo _e( 'Read more', THEMEDOMAIN ); ?> →</a>
	    
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
    	
    	<div class="sidebar_wrapper">
    	
    	    <div class="sidebar_top"></div>
    	
    	    <div class="sidebar">
    	    
    	    	<div class="content">
    	    
    	    		<ul class="sidebar_widget">
    	    		<?php dynamic_sidebar('Tag Sidebar'); ?>
    	    		</ul>
    	    	
    	    	</div>
    	
    	    </div>
    	    <br class="clear"/>
    	
    	    <div class="sidebar_bottom"></div>
    	</div>
    	
    	</div>
    
    </div>
    <!-- End main content -->
    
</div>

<?php get_footer(); ?>