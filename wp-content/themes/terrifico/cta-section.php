<?php
/**
 * @package Terrifico
 */
$terrifico_theme_options = terrifico_get_options( 'terrifico_theme_options' );
$cta_bg_image = $terrifico_theme_options['cta_bg_image'];

if ($cta_bg_image !='') { ?>
	<div class="cta" style="background: url(<?php echo esc_url($cta_bg_image); ?>) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
<?php } else { ?>
	<div class="cta">
<?php } ?>
	<div id="cta-wrap">
		<div>
			<h4 class="wow bounceInRight" data-wow-delay="0.1s"><?php echo esc_attr($terrifico_theme_options['cta_section_sm_header']); ?> </h4>
			<h2 class="boxtitle wow bounceInLeft" data-wow-delay="0.1s"><?php echo esc_attr($terrifico_theme_options['cta_section_big_header']); ?></h2>
			<a class="content-btn" href="<?php echo esc_url($terrifico_theme_options['cta_button_url']); ?>"><?php echo esc_attr($terrifico_theme_options['cta_button_text']); ?></a>
		</div>
	</div>
</div>