<?php
 
// Featured Images / Post Thumbnails
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
}
 
function get_thumbnail_path($post_ID) {
	$post_image_id = get_post_thumbnail_id($post_ID->ID);
	if ($post_image_id) {
		$thumbnail = wp_get_attachment_image_src( $post_image_id, 'post-thumbnail', false);
		if ($thumbnail) (string)$thumbnail = $thumbnail[0];
		return $thumbnail;
	}	
}

?>