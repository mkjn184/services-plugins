<?php
/**
Plugin Name: Welcome Messages
Description: show message
Author: Mohamed Ajour
Version: 1.0
Author URI: http://www.majour.eb2a.com
 */
function ssw_plugin_table(){

global $wpdb;

$table_name = $wpdb->prefix.'ssw_customers';
$charset_collate = $wpdb->get_charset_collate(); //utf8mb4_unicode_ci
$sql = "CREATE TABLE $table_name (
`id` INT NOT NULL AUTO_INCREMENT,
`customer_name` VARCHAR(255) NOT NULL,
PRIMARY KEY (`id`))$charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );

}
register_activation_hook( __FILE__, 'ssw_plugin_table' );
function extratest(){}
// Register Custom Post Type
function ssw_seo(){
    $post_type = 'SEO';
    $labels = array(
        'name' => 'SEO' ,
        'singular_name' => 'SEO' ,
        'add_new' => 'Add SEO' ,
        'add_new_item' => 'Add New SEO',
        'edit_item' => 'Edit SEO',
        'new_item' => 'New SEO',
        'view_item' => 'View SEO',
        'view_items' => 'View SEO',
        'search_items' => 'Search SEO',
        'items_list' => 'SEO list'
    );
    $taxonomies = array(
        'category'
    );
    $supports = array(
        'title',
        'editor',
        'author',
        'thumbnail',
        'excerpt',
        'trackbacks',
        'custom-fields',
        'comments',
        'revisions',
        'page-attributes',
        'post-formats'
    );
    $args = array(
        'labels' => $labels,
        'show_in_nav_menus'=> true,
        'exclude_from_search' =>false,
        'public' => true ,
        'show_in_menu' => true,
        'menu_position' => 15 ,
        'menu_icon' => 'dashicons-video-alt',
        'taxonomies' => $taxonomies,
        'supports' => $supports
    );
    register_post_type( $post_type, $args );
}

add_action('init' , 'ssw_seo');

add_shortcode( 'welcome_message', 'ssw_print_form');
function im_print_form(){
if(isset($_POST['custom_name'])){
$username = $_POST['custom_name']+10;
echo get_option('ssw_welcome_message').': '.$username;
}
?>
<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
    <label for="">Name</label>
    <input type="text" name="custom_name">
    <input type="submit" value="Submit">
</form>
<?php
}
add_filter('the_title', 'new_title', 10, 2);
function new_title($title, $id) {
    return 'Mohamed => '.$title;

}
require_once (plugin_dir_path(__FILE__).'functions.php');
require_once (plugin_dir_path(__FILE__).'options.php');