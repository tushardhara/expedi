<?php
/*
	Begin creating admin options
*/

$themename = THEMENAME;
$shortname = SHORTNAME;

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array(
	0		=> "Choose a category"
);
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}

$pages = get_pages(array('parent' => -1));
$wp_pages = array(
	0		=> "Choose a page"
);
foreach ($pages as $page_list ) {
       $wp_pages[$page_list->ID] = $page_list->post_title;
}

$galleries = get_posts(array('parent' => -1, 'post_type' => 'gallery', 'numberposts' => -1));
$wp_galleries = array(
	0		=> "Choose a gallery"
);
foreach ($galleries as $gallery_list ) {
       $wp_galleries[$gallery_list->ID] = $gallery_list->post_title;
}

$api_url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

$options = array (
 
//Begin admin header
array( 
		"name" => $themename." Options",
		"type" => "title"
),
//End admin header
 

//Begin first tab "General"
array( 
		"name" => "General",
		"type" => "section",
		"icon" => "gear.png",
)
,

array( "type" => "open"),

array( "name" => "<h2>Website Identity</h2>Logo",
	"desc" => "Image logo which shows above of main menu",
	"id" => $shortname."_logo",
	"type" => "image",
	"std" => "",
),
array( "name" => "Custom Favicon",
	"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
	"id" => $shortname."_favicon",
	"type" => "image",
	"std" => "",
),
array( "name" => "<h2>Global Image Settings</h2>Enable/disable right click (for image protection)",
	"desc" => "",
	"id" => $shortname."_enable_right_click",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Right click alert text (If enable image protection)",
	"desc" => "It will displays this message when user do right click",
	"id" => $shortname."_right_click_text",
	"type" => "text",
	"std" => "Images are copyright by me :)"
),
array( "name" => "<h2>Advanced Settings</h2>Google Analytics Code",
	"desc" => "Get analytics on your site. Simply give us your Google Analytics code",
	"id" => $shortname."_ga_code",
	"type" => "textarea",
	"std" => ""
),
array( "name" => "Enable/disable responsive layout",
	"desc" => "",
	"id" => $shortname."_enable_responsive",
	"type" => "iphone_checkboxes",
	"std" => 1
),
	
array( "type" => "close"),
//End first tab "General"

//Begin first tab "General"
array( 
		"name" => "Skins",
		"type" => "section",
		"icon" => "color-swatch.png",
),

array( "type" => "open"),

array( "name" => "Save current settings as Skin",
	"desc" => "Skin manager helps you save all settings (except homepage, contact fields and advanced settings) to a skin so you can easily enable it later. Below are your current available skins.",
	"id" => $shortname."_skin",
	"type" => "skin",
	"std" => ""
),
	
array( "type" => "close"),
//End first tab "Skins"

//Begin first tab "Typography"
array( 
		"name" => "Typography",
		"type" => "section",
		"icon" => "text_dropcaps.png",
)
,

array( "type" => "open"),

array( "name" => "<h2>Header Font Settings</h2>Header Font (using Google Webfonts API)",
	"desc" => "Select font style your header",
	"id" => $shortname."_font",
	"type" => "font",
	"std" => ''
),
array( "name" => "H1 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h1_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "40",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H2 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h2_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "32",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H3 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h3_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "26",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H4 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h4_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "24",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H5 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h5_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "22",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H6 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h6_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "18",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "<h2>Main Menu Font Settings</h2>Menu font Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_menu_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "20",
	"from" => 11,
	"to" => 24,
	"step" => 1,
),
array( "name" => "Sub Menu font Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_submenu_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "16",
	"from" => 11,
	"to" => 24,
	"step" => 1,
),
array( "name" => "Make Menu font lowercase",
	"desc" => "",
	"id" => $shortname."_menu_lower",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Gallery Font Settings</h2>Fullscreen Image Title font size (in pixels)",
	"desc" => "",
	"id" => $shortname."_image_title_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "22",
	"from" => 16,
	"to" => 30,
	"step" => 1,
),
	
array( "type" => "close"),
//End first tab "Typography"


//Begin second tab "Google Web Fonts"
array( "name" => "Google-Fonts",
	"type" => "section",
	"icon" => "ggwebfont.png",
),

array( "type" => "open"),

array( "name" => "<h2>Google Web Fonts Settings</h2>You can add additional Google Web Font.",
	"desc" => "Enter font name ex. Courgette <a href=\"http://www.google.com/webfonts\">Checkout Google Web Font Directory</a>",
	"id" => $shortname."_ggfont0",
	"type" => "text",
	"std" => "",
),
array( "type" => "close"),
//End second tab "Google Web Fonts"


//Begin first tab "Styling"
array( 
		"name" => "Styling",
		"type" => "section",
		"icon" => "palette.png",
)
,

array( "type" => "open"),

array( "name" => "<h2>Global Colors Settings</h2>Font Color",
	"desc" => "Select color for the font",
	"id" => $shortname."_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ebebeb"
),

array( "name" => "Content Background Color",
	"desc" => "Select color for content background",
	"id" => $shortname."_content_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Content Background Opacity",
	"desc" => "Select opacity value for content background",
	"id" => $shortname."_content_opacity_color",
	"type" => "jslider",
	"size" => "40px",
	"std" => "60",
	"from" => 10,
	"to" => 100,
	"step" => 5,
),

array( "name" => "Link Color",
	"desc" => "Select color for the link",
	"id" => $shortname."_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Hover Link Color",
	"desc" => "Select color for the hover background color",
	"id" => $shortname."_hover_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#fff200"
),

array( "name" => "H1, H2, H3, H4, H5, H6 Color",
	"desc" => "Select color for the H1, H2, H3, H4, H5, H6",
	"id" => $shortname."_h1_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Button Background Color",
	"desc" => "Select color for the button background",
	"id" => $shortname."_button_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#fff200"
),

array( "name" => "Button Font Color",
	"desc" => "Select color for the button font",
	"id" => $shortname."_button_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Button Border Color",
	"desc" => "Select color for the button border",
	"id" => $shortname."_button_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#fff200"
),

array( "name" => "<h2>Main Menu Colors Settings</h2>Menu Font Color",
	"desc" => "Select color for menu font",
	"id" => $shortname."_menu_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Sub Menu Font Color",
	"desc" => "Select color for submenu font",
	"id" => $shortname."_submenu_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Menu Hover Font Color",
	"desc" => "Select color for menu font in hover state",
	"id" => $shortname."_menu_hover_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#fff200"
),

array( "name" => "Menu Active Font Color",
	"desc" => "Select color for menu font in active state",
	"id" => $shortname."_menu_active_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#fff200"
),


array( "type" => "close"),
//End first tab "Styling"


//Begin second tab "Homepage"
array( 	"name" => "Homepage",
		"type" => "section",
		"icon" => "home.png",
),
array( "type" => "open"),

array( "name" => "<h2>Content Settings</h2>Homepage styles",
	"desc" => "Select the style for homepage",
	"id" => $shortname."_homepage_style",
	"type" => "select",
	"options" => array(
		'fullscreen' => 'Fullscreen Slideshow',
		'static' => 'Static Image',
		'youtube' => 'Fullscreen Youtube Video',
		'vimeo' => 'Fullscreen Vimeo Video',
	),
	"std" => 1
),
array( "name" => "Choose Homepage Gallery",
	"desc" => "",
	"id" => $shortname."_homepage_slideshow_cat",
	"type" => "select",
	"options" => $wp_galleries,
	"std" => ""
),
array( "name" => "Background Music .mp3 file ",
	"desc" => "<strong>MP3 format for Older browsers</strong><br/><a href=\"http://www.google.co.th/search?q=mp3+format&ie=utf-8&oe=utf-8&aq=t&rls=org.mozilla:en-US:official&client=firefox-a\">More info</a>",
	"id" => $shortname."_homepage_music_mp3",
	"type" => "music",
	"std" => "",
),
array( "name" => "<h2>Static Background Image Settings</h2>Hompage Background Image",
	"desc" => "Select image for homepage background (if select Static Image style)",
	"id" => $shortname."_homepage_bg",
	"type" => "image",
	"size" => "290px",
),
array( "name" => "<h2>Fullscreen Youtube Video Settings</h2>Hompage Youtube Video ID",
	"desc" => "Enter Youtube Video ID ex. 5pEbJpjxbbU (if select Fullscreen Youtube Video style)",
	"id" => $shortname."_homepage_youtube_id",
	"type" => "text",
	"std" => '5pEbJpjxbbU',
),
array( "name" => "<h2>Fullscreen Vimeo Video Settings</h2>Hompage Vimeo Video ID",
	"desc" => "Enter Vimeo Video ID ex. 58363796 (if select Fullscreen Vimeo Video style)",
	"id" => $shortname."_homepage_vimeo_id",
	"type" => "text",
	"std" => '58363796',
),

array( "type" => "close"),
//End second tab "Homepage"

array( 	"name" => "Blog",
		"type" => "section",
		"icon" => "book-open-bookmark.png",
),
array( "type" => "open"),

array( "name" => "<h2>Single Post Page Settings</h2>Single Post Page Layout",
	"desc" => "",
	"id" => $shortname."_blog_single_layout",
	"type" => "select",
	"options" => array(
		'page_sidebar' => 'With Sidebar',
		'fullwidth' => 'Fullwidth',
	),
	"std" => 1
),
array( "name" => "Enable/disable social media sharing",
	"desc" => "",
	"id" => $shortname."_blog_social_sharing",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Other Settings</h2>Display full blog post content on blog page",
	"desc" => "",
	"id" => $shortname."_blog_display_full",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Archive, Category, Search, Tag pages Background Image",
	"desc" => "Select image for blog background (Recommended size 1440x900 pixels)",
	"id" => $shortname."_blog_bg",
	"type" => "image",
	"size" => "290px",
),
array( "name" => "Archive, Category, Search, Tag pages Layout position",
	"desc" => "",
	"id" => $shortname."_blog_up_down_layout",
	"type" => "select",
	"options" => array(
		'up' => 'up',
		'down' => 'down',
	),
	"std" => 1
),
array( "name" => "Archive, Category, Search, Tag pages Layout Extra buttton position",
	"desc" => "",
	"id" => $shortname."_blog_ex_button_layout",
	"type" => "select",
	"options" => array(
		'off' => 'off',
		'on' => 'on',
	),
	"std" => 1
),
array( "type" => "close"),


//Begin second tab "Sidebar"
array( 	"name" => "Sidebar",
		"type" => "section",
		"icon" => "application-sidebar-expand.png",	
),
array( "type" => "open"),

array( "name" => "Add a new sidebar",
	"desc" => "Enter sidebar name",
	"id" => $shortname."_sidebar0",
	"type" => "text",
	"std" => "",
),
array( "type" => "close"),
//End second tab "Sidebar"


//Begin fourth tab "Contact"
array( 	"name" => "Contact",
		"type" => "section",
		"icon" => "mail-receive.png",
),
array( "type" => "open"),
	

array( "name" => "Your email address",
	"desc" => "Enter which email address will be sent from contact form",
	"id" => $shortname."_contact_email",
	"type" => "text",
	"std" => ""

),
array( "name" => "Select and sort contents on your contact page. Use fields you want to show on your contact form",
	"sort_title" => "Contact Form Manager",
	"desc" => "",
	"id" => $shortname."_contact_form",
	"type" => "sortable",
	"options" => array(
		0 => 'Empty field',
		1 => 'Name',
		2 => 'Email',
		3 => 'Message',
		4 => 'Address',
		5 => 'Phone',
		6 => 'Mobile',
		7 => 'Company Name',
		8 => 'Country',
	),
	"options_disable" => array(1, 2, 3),
	"std" => ''
),
array( "name" => "<h2>Map Setting</h2>Show map in contact page",
	"desc" => "If you enable this option. It will display map as background on contact page",
	"id" => $shortname."_contact_display_map",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Address Latitude",
	"desc" => "<a href=\"http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/\">Find here</a>",
	"id" => $shortname."_contact_lat",
	"type" => "text",
	"std" => ""
),
array( "name" => "Address Longtitude",
	"desc" => "<a href=\"http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/\">Find here</a>",
	"id" => $shortname."_contact_long",
	"type" => "text",
	"std" => ""
),
array( "name" => "Map Zoom level",
	"desc" => "",
	"id" => $shortname."_contact_map_zoom",
	"type" => "jslider",
	"size" => "40px",
	"std" => "12",
	"from" => 1,
	"to" => 18,
	"step" => 1,
),
array( "name" => "Map Info box content",
	"desc" => "Enter text to display in map info box",
	"id" => $shortname."_contact_info_box",
	"type" => "text",
	"std" => ""
),
/*array( "name" => "<h2>Captcha Settings</h2>Enable/disable Captcha",
	"desc" => "",
	"id" => $shortname."_contact_enable_captcha",
	"type" => "iphone_checkboxes",
	"std" => 1
),*/

//End fourth tab "Contact"

//Begin fifth tab "Social Profiles"
array( "type" => "close"),
array( 	"name" => "Social-Profiles",
		"type" => "section",
		"icon" => "social.png",
),
array( "type" => "open"),
	
array( "name" => "<h2>Accounts Settings</h2>Facebook Profile ID",
	"desc" => "",
	"id" => $shortname."_facebook_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Twitter Username",
	"desc" => "",
	"id" => $shortname."_twitter_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Google Plus URL",
	"desc" => "",
	"id" => $shortname."_google_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Flickr Username",
	"desc" => "",
	"id" => $shortname."_flickr_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Youtube Username",
	"desc" => "",
	"id" => $shortname."_youtube_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Vimeo Username",
	"desc" => "",
	"id" => $shortname."_vimeo_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Tumblr Username",
	"desc" => "",
	"id" => $shortname."_tumblr_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Digg Username",
	"desc" => "",
	"id" => $shortname."_digg_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Dribbble Username",
	"desc" => "",
	"id" => $shortname."_dribbble_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Linkedin URL",
	"desc" => "",
	"id" => $shortname."_linkedin_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Pinterest Username",
	"desc" => "",
	"id" => $shortname."_pinterest_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Instagram Username",
	"desc" => "",
	"id" => $shortname."_instagram_username",
	"type" => "text",
	"std" => ""
),

//End fifth tab "Social Profiles"

//Begin fifth tab "Footer"
array( "type" => "close"),
array( 	"name" => "Footer",
		"type" => "section",
		"icon" => "layout-select-footer.png",
),
array( "type" => "open"),
	
array( "name" => "<h2>Footer Layouts and Styles Settings</h2>Show Footer Sidebar",
	"desc" => "If you enable this option, you can add widgets to \"Footer Sidebar\" using Appearance > Widgets",
	"id" => $shortname."_footer_display_sidebar",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Footer Sidebar styles",
	"desc" => "Select the style for Footer Sidebar",
	"id" => $shortname."_footer_style",
	"type" => "radio",
	"options" => array(
		'1' => '<div style="float:left;width:50px;height:40px" class="pp_checkbox_wrapper"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/1column.png"/></div>',
		'2' => '<div style="float:left;width:50px;height:40px" class="pp_checkbox_wrapper"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/2columns.png"/></div>',
		'3' => '<div style="float:left;width:50px;height:40px" class="pp_checkbox_wrapper"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/3columns.png"/></div>',
		'4' => '<div style="float:left;width:50px;height:40px" class="pp_checkbox_wrapper"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/4columns.png"/></div>',
	),
),
array( "name" => "Footer text",
	"desc" => "Enter footer text ex. copyright description",
	"id" => $shortname."_footer_text",
	"type" => "textarea",
	"std" => ""
),
//End fifth tab "Footer"
array( "type" => "close"),

//Begin second tab "Utilities"
array( "name" => "Utilities",
	"type" => "section",
	"icon" => "wrench-screwdriver.png",
),

array( "type" => "open"),

array( "name" => "Combine and compress theme's CSS files",
	"desc" => "Combine and compress all CSS files to one. Help reduce page load time",
	"id" => $shortname."_advance_combine_css",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Combine and compress theme's javascript files",
	"desc" => "Combine and compress all javascript files to one. Help reduce page load time",
	"id" => $shortname."_advance_combine_js",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Clear Cache",
	"desc" => "Try to clear cache when you enable javascript and CSS compression and theme went wrong",
	"id" => $shortname."_advance_clear_cache",
	"type" => "html",
	"html" => '<a id="'.$shortname.'_advance_clear_cache" href="'.$api_url.'" class="button">Click here to start clearing cache files</a>',
),
 
array( "type" => "close")
 
);
?>