<?php
/*
Plugin Name: Easy Recent Posts
Plugin URI: http://thisismyurl.com/downloads/wordpress/plugins/easy-recent-posts/
Description: An easy to use WordPress function to add Recent Posts to any theme.
Author: Christopher Ross
Tags: future, upcoming posts, upcoming post, upcoming, draft, Post, recent, preview, plugin, post, posts
Author URI: http://thisismyurl.com
Version: 2.0.1
*/


/*  Copyright 2011  Christopher Ross  (email : info@thisismyurl.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_shortcode( 'thisismyurl_easy_recent_posts', 'thisismyurl_easy_recent_posts' );

function thisismyurl_easy_recent_posts($options = '' ) {
	$ns_options = array(
		"count"    => "10",
		"link" => false,
		"before"   => "<li>",
		"after"    => "</li>\n",
		"order"    => "desc",
		"nofollow" => false,
		"excerpt" => false,
		"featureimage" => false,
		"show"     => true
	);

	$options = explode( "&", $options );
	foreach ( $options as $option ) {
		$parts = explode( "=", $option );
		$ns_options[$parts[0]] = $parts[1];
	}
	$args = array( 'numberposts' => $ns_options['count'], 'order' => $ns_options['order'] );
	$recent_posts = get_posts( $args );
	
    foreach ( $recent_posts as $post ) {
		$recent .=  $ns_options['before'];
		if ($ns_options['link'] == 'true') {
			$recent .= "<a href='".get_permalink($post->ID)."' ";
			if ($ns_options['nofollow'] == 'true') {$recent .= 'nofollow';}
			$recent .= ">";
		}
		$recent .=  "<span class='title'>".get_the_title($post->ID)."</title>";
		if ($ns_options['link'] == 'true') {$recent .= "</a>";}
		if ($ns_options['featureimage'] == 'true') {
			if (has_post_thumbnail($post->ID)) {$recent .=  "<div class='thumbnail'>".get_the_post_thumbnail($post->ID,'thumbnail')."</div>";}
		}
		if ($ns_options['excerpt'] == 'true') {$recent .=  "<div class='excerpt'>".get_the_excerpt($post->ID)."</div>";}
		$recent .=  $ns_options['after'];
    }
	
	if ( $ns_options['show'] ) {
		echo $recent;
	} else {
		return $recent;
	}
}

class thisismyurl_recent_posts_widget extends WP_Widget
{
	
	
	function thisismyurl_recent_posts_widget(){
		$widget_ops = array('classname' => 'widget_thisismyurl_recent_posts', 'description' => __( "A WordPress widget to add recent posts to any WordPress theme.") );
		$control_ops = array('width' => 300, 'height' => 300);
		$this->WP_Widget('thisismyurl_recent_posts_widget', __('Recent Posts by Christopher Ross'), $widget_ops, $control_ops);
	}

	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['count'] = strip_tags(stripslashes($new_instance['count']));
		$instance['order'] = strip_tags(stripslashes($new_instance['order']));
		$instance['link'] = strip_tags(stripslashes($new_instance['link']));
		$instance['excerpt'] = strip_tags(stripslashes($new_instance['excerpt']));
		$instance['featureimage'] = strip_tags(stripslashes($new_instance['featureimage']));

		return $instance;
	}

	function form($instance){
		$instance = wp_parse_args( (array) $instance, array('title'=>'Recent Posts', 'count'=>'5', 'order'=>'desc', 'link'=>'true', 'excerpt'=>'false', 'featureimage'=>'false') );

		$title = htmlspecialchars($instance['title']);
		$count = htmlspecialchars($instance['count']);
		$order = htmlspecialchars($instance['order']);
		$link = htmlspecialchars($instance['link']);
		$excerpt = htmlspecialchars($instance['excerpt']);
		$featureimage = htmlspecialchars($instance['featureimage']);

		for ($i = 5; $i <= 25; $i=$i+5) {
			$countoption .= "<option value='$i' ";
			if ($count == $i) {$countoption .= "selected";}
			$countoption .= ">$i</option>";
		}
	
		if ($order == "desc") {$orderoption .= "<option value='desc' selected >Descending</option>";} else {$orderoption .= "<option value='desc'>Descending</option>";}
		if ($order == "asc") {$orderoption .= "<option value='asc' selected >Ascending</option>";} else {$orderoption .= "<option value='asc'>Ascending</option>";}


		if ($link == "true") {$linkoption .= "<option value='true' selected >Yes</option>";} else {$linkoption .= "<option value='true'>Yes</option>";}
		if ($link == "false") {$linkoption .= "<option value='false' selected >No</option>";} else {$linkoption .= "<option value='false'>No</option>";}

		if ($excerpt == "true") {$excerptoption .= "<option value='true' selected >Yes</option>";} else {$excerptoption .= "<option value='true'>Yes</option>";}
		if ($excerpt == "false") {$excerptoption .= "<option value='false' selected >No</option>";} else {$excerptoption .= "<option value='false'>No</option>";}

		if ($featureimage == "true") {$featureimageoption .= "<option value='true' selected >Yes</option>";} else {$featureimageoption .= "<option value='true'>Yes</option>";}
		if ($featureimage == "false") {$featureimageoption .= "<option value='false' selected >No</option>";} else {$featureimageoption .= "<option value='false'>No</option>";}

	
		# Output the options
		echo '	<p style="text-align:left;"><label for="' . $this->get_field_name('title') . '">' . __('Title:') . '</label><br />
				<input style="width: 300px;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" />
				</p>';
		echo '	<p style="text-align:left;"><label for="' . $this->get_field_name('count') . '">' . __('Count:') . '</label><br />
				<select id="' . $this->get_field_id('count') . '" name="' . $this->get_field_name('count') . '">'.$countoption.'</select>
				</p>';	
		
		echo '	<p style="text-align:left;"><label for="' . $this->get_field_name('order') . '">' . __('Order:') . '</label><br />
				<select id="' . $this->get_field_id('order') . '" name="' . $this->get_field_name('order') . '">'.$orderoption.'</select>
				</p>';
				
		echo '	<p style="text-align:left;"><label for="' . $this->get_field_name('link') . '">' . __('Include Link?') . '</label><br />
				<select id="' . $this->get_field_id('link') . '" name="' . $this->get_field_name('link') . '">'.$linkoption.'</select>
				</p>';
		
		echo '	<p style="text-align:left;"><label for="' . $this->get_field_name('excerpt') . '">' . __('Include Excerpt?') . '</label><br />
				<select id="' . $this->get_field_id('excerpt') . '" name="' . $this->get_field_name('excerpt') . '">'.$excerptoption.'</select>
				</p>';
				
		echo '	<p style="text-align:left;"><label for="' . $this->get_field_name('featureimage') . '">' . __('Include Thumbnail?') . '</label><br />
				<select id="' . $this->get_field_id('featureimage') . '" name="' . $this->get_field_name('featureimage') . '">'.$featureimageoption.'</select>
				</p>';

	}


	/*  Displays the Widget */
	function widget($args, $instance){
		extract( $args );
		$instance = wp_parse_args( (array) $instance, array('title'=>'Recent Posts', 'count'=>'5', 'order'=>'desc', 'link'=>'true') );

		# Before the widget
		echo $before_widget;
		echo '<h3 class="widgettitle">'.$instance['title'].'</h3>';
		echo '<ul>'.thisismyurl_easy_recent_posts('show=0&link='.$instance['link'].'&count='.$instance['count'].'&order='.$instance['order'].'&excerpt='.$instance['excerpt'].'&featureimage='.$instance['featureimage']).'</ul>';
		echo $after_widget;

	}

}// END class

function thisismyurl_recent_posts_widget_Init() {
	register_widget('thisismyurl_recent_posts_widget');
}
add_action('widgets_init', 'thisismyurl_recent_posts_widget_Init');
?>