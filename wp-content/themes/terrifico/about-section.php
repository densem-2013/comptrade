<?php
/**
 * @package Terrifico
 */
$terrifico_theme_options = terrifico_get_options( 'terrifico_theme_options' );
$about_bg_image = $terrifico_theme_options['about_bg_image'];

if ($about_bg_image != '') { ?>
	<div class="about" style="background: url(<?php echo esc_url($about_bg_image); ?>) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"> 
<?php } else { ?>
	<div class="about">
<?php } ?>
	<div id="about-wrap">
		<div>
			<h2 class="boxtitle wow bounceInLeft" data-wow-delay="0.1s"><?php echo esc_attr($terrifico_theme_options['about_section_header']); ?></h2>
			<p class="text wow bounceInRight" data-wow-delay="0.2s"><?php echo esc_attr($terrifico_theme_options['about_section_text']); ?> </p>
		</div>
	</div>
</div>