<?php
/*
Plugin Name: CF Tag Archive RSS
Plugin URI: 
Description: This appends an RSS link for each tag's link on a tag archive page (or any time 'wp_generate_tag_cloud' is called).  Several filters allow it to be highly customizable.
Version: 1.0
Author: Crowd Favorite
Author URI: http://crowdfavorite.com
*/

function cf_tag_archive_rss($return, $tags, $args) {
	$return = "<ul class='wp-tag-cloud'>";
	foreach ($tags as $tag) {
		/* Allow links to be nearly completely filterable */
		$tag_title = apply_filters('cf_tag_archive_rss_tag_link_title', 'View all posts tagged with '.$tag->name, $tag);
		$tag_link_text = apply_filters('cf_tag_archive_rss_tag_link_text', $tag->name, $tag, $args);
		$tag_link_class = apply_filters('cf_tag_archive_rss_tag_link_class', '', $tag, $args);
		$rss_title = apply_filters('cf_tag_archive_rss_link_title', 'RSS', $tag, $args);
		$rss_link_text = apply_filters('cf_tag_archive_rss_link_text', 'RSS', $tag, $args);
		$rss_link_class = apply_filters('cf_tag_archive_rss_link_class', '', $tag, $args);
		
		/* Put it all together */
		$return .= '<li><a href="'.$tag->link.'" title="'.esc_attr($tag_title).'" class="'.esc_attr($tag_link_class).'">'.$tag_link_text.'</a> (<a href="'.get_tag_feed_link($tag->id).'" title="'.esc_attr($rss_link_title).'" class="'.esc_attr($rss_link_class).'">'.$rss_link_text.'</a>)</li>';
	}
	$return .= "</ul>";
	return $return;
}
add_filter( 'wp_generate_tag_cloud', 'cf_tag_archive_rss', 10, 3);
?>