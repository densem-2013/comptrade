<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Terrifico
 */
$terrifico_theme_options = terrifico_get_options( 'terrifico_theme_options' );
get_header(); ?>
	<div id="main" class="<?php echo esc_attr($terrifico_theme_options['layout_settings']);?>">
	<?php
		// Start the Loop.
		while ( have_posts() ) : the_post();

			get_template_part( 'content', 'single');
		
		endwhile;
	?>
	</div><!--main-->
<?php if ($terrifico_theme_options['social_section_on'] == '1') {
	get_template_part( 'social', 'section' );	
}
get_footer(); ?>