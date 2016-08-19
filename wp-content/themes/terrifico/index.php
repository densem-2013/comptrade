<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Terrifico
 */
$terrifico_theme_options = terrifico_get_options( 'terrifico_theme_options' );
get_header(); ?>
	<div id="main" class="<?php echo esc_attr($terrifico_theme_options['layout_settings']); ?>">
	<?php 
		if (is_front_page() && ! is_paged()) {
		
			if ($terrifico_theme_options['image_slider_on'] == '1') {
					
				 terrifico_flex_slider(); 
				
			}

			if ($terrifico_theme_options['getstarted_section_on'] == '1') {
			
				get_template_part( 'getstarted', 'section' );
				
			}
			
			if ($terrifico_theme_options['features_section_on'] == '1') {
			
				get_template_part( 'features', 'section' );
				
			}
						
			if ($terrifico_theme_options['about_section_on'] == '1') {
			
				get_template_part( 'about', 'section' );
				
			}
			
			
			if ($terrifico_theme_options['services_section_on'] == '1') {
			
				get_template_part( 'services', 'section' );
				
			}
			
			if ($terrifico_theme_options['cta_section_on'] == '1') {
			
				get_template_part( 'cta', 'section' );
				
			}
			
			if ($terrifico_theme_options['content_boxes_section_on'] == '1') {
			
				get_template_part( 'contentboxes', 'section' );
				
			}
			
			if ($terrifico_theme_options['getin_home_on'] == '1') {
			
				get_template_part( 'getintouch', 'section' );
				
			}
			
			if ($terrifico_theme_options['blog_section_on'] == '1') {
			
				get_template_part( 'fromblog', 'section' );
				
			}
			
			if ($terrifico_theme_options['latest_posts_on'] == '1') {
			
				get_template_part( 'content-posts', 'home' );
				
			}		
		
		} else {
		
			get_template_part( 'content', 'posts' );
		
		} ?>
	</div><!--main-->
	<?php if ($terrifico_theme_options['social_section_on'] == '1') {
			get_template_part( 'social', 'section' );	
		}
get_footer(); ?>