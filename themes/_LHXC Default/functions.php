<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

if ( function_exists('register_sidebars') )
register_sidebars(3);

if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
// end original functions
    
    // Replace login logo
function custom_login() {
	echo '<style type="text/css">
		html {background:#000;}
		h1 a { background-image: url(http://forums.louisvillehardcore.com/styles/LHXC/imageset/site_logo.gif); height:100px;
		 }
		 </style>';
}
add_action('login_head', 'custom_login');

function lhxc_copyright() {
global $wpdb;
$copyright_dates = $wpdb->get_results("
SELECT
YEAR(min(post_date_gmt)) AS firstdate,
YEAR(max(post_date_gmt)) AS lastdate
FROM
$wpdb->posts
WHERE
post_status = 'publish'
");
$output = '';
if($copyright_dates) {
$copyright = "&copy; " . $copyright_dates[0]->firstdate;
if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
$copyright .= '-' . $copyright_dates[0]->lastdate;
}
$output = $copyright;
}
return $output;
}

// Add thumbnails
add_theme_support( 'post-thumbnails' );
// Paste this where you wanna use it - the_post_thumbnail();

// Hide that stupid shit Links panel
add_action( 'admin_init', 'my_remove_menu_pages' );
function my_remove_menu_pages() {
	remove_menu_page('link-manager.php');
}?>
