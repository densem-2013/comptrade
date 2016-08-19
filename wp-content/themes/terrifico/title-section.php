<?php 
/**
 * @package Terrifico
 *
 */
global $post; 

    if (is_category() || is_single()) {
    	$category = get_the_category(); 
			if($category[0]){
				echo '<h1 class="section-title-right">'; echo esc_attr($category[0]->cat_name); echo '</h1>';
			}    
	} 
		elseif (is_page()) {
		   echo '<h1 class="section-title-right" title="'.esc_attr(get_the_title()).'"> '.esc_attr(get_the_title()).'</h1>';
    }  
		elseif (is_tag()) {
			echo '<h1 class="section-title-right">'; _e('Tag: ','terrifico');esc_attr(single_tag_title()); echo '</h1>';
	}
		elseif (is_day()) {
			echo'<h1 class="section-title-right"> ' . __('Archive for ','terrifico'); esc_attr(the_archive_title()); echo'</h1>';
	}
		elseif (is_month()) {
			echo'<h1 class="section-title-right">' . __('Archive for ','terrifico'); esc_attr(the_archive_title()); echo'</h1>';
	}
		elseif (is_year()) {
			echo'<h1 class="section-title-right">' . __('Archive for ','terrifico'); esc_attr(the_archive_title()); echo'</h1>';
	}
		elseif (is_author()) {
			echo'<h1 class="section-title-right">' . __('Author: ','terrifico'); esc_url(the_author_posts_link()); echo'</h1>';
	}
		elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
			echo '<h1 class="section-title-right">' . __('Blog Archives ','terrifico'); echo'</h1>';
	}
		elseif (is_search()) {
			echo'<h1 class="section-title-right">' . __('Search Results ','terrifico'); echo'</h1>';
	}
		else {
			echo'<h1 class="section-title-right">' . __('Blog Posts ','terrifico'); echo'</h1>';
	}	


