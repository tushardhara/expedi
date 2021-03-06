<?php
/**
 * The main template file for display fullscreen vimeo video
 *
 * Template Name: Fullscreen Vimeo Video
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
<?php $page_vimeo_id = get_post_meta($current_page_id, 'page_vimeo_id', true); ?>
<div class="page_control">
    <a id="page_minimize" href="#">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_minus.png" alt=""/>
    </a>
    <a id="page_maximize" href="#">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_plus.png" alt=""/>
    </a>
</div>
<div id="vimeo_bg">
	<iframe id="i_frame" class="vimeo" frameborder="0" src="http://player.vimeo.com/video/<?php echo $page_vimeo_id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff&amp;autoplay=true" width="100%" height="100%" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</div>

<?php $page_menu_style=($page_menu_option=='off' ? 'no-menu' : '');?>
<div id="page_content_wrapper" class="page_content_wrapper no-half <?php echo $page_content_position;?> <?php echo $page_menu_style;?>">

    <div class="inner">
    
    <!-- Begin main content -->
    <div class="inner_wrapper">
    
    	
        
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		
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
                    <div class="content_read">
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