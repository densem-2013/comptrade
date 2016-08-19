<?php
/**
 * @package Terrifico
 */
$terrifico_theme_options = terrifico_get_options( 'terrifico_theme_options' );
$cntbx_bg_image = $terrifico_theme_options['cntbx_bg_image'];

if ($cntbx_bg_image != '') { ?>
	<div class="content-boxes" style="background: url(<?php echo esc_url($cntbx_bg_image); ?>) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
<?php } else { ?>	
	<div class="content-boxes">
<?php } ?>
	<div id="content-boxes-wrap">
		<div class="col wow bounceIn" data-wow-delay="0.2s">
			<div class="circle">
				<i class="fa <?php echo esc_attr($terrifico_theme_options['first_column_image']); ?>"></i>
			</div>
			<h4><?php echo esc_attr($terrifico_theme_options['first_column_header']); ?></h4>
			<p><?php echo esc_attr($terrifico_theme_options['first_column_text']); ?></p>
			<a class="content-btn" href="<?php echo esc_url($terrifico_theme_options['first_column_url']); ?>"><?php _e('Read More','terrifico'); ?></a>
		</div>
		<div class="col wow bounceIn" data-wow-delay="0.5s">
			<div class="circle">	
				<i class="fa <?php echo esc_attr($terrifico_theme_options['second_column_image']); ?>"></i>
			</div>
			<h4><?php echo esc_attr($terrifico_theme_options['second_column_header']); ?></h4>
			<p><?php echo esc_attr($terrifico_theme_options['second_column_text']); ?></p>
			<a class="content-btn" href="<?php echo esc_url($terrifico_theme_options['second_column_url']); ?>"><?php _e('Read More','terrifico'); ?></a>
		</div>
		<div class="col wow bounceIn" data-wow-delay="0.8s">
			<div class="circle">	
				<i class="fa <?php echo esc_attr($terrifico_theme_options['third_column_image']); ?>"></i>
			</div>
			<h4><?php echo esc_attr($terrifico_theme_options['third_column_header']); ?></h4>
			<p><?php echo esc_attr($terrifico_theme_options['third_column_text']); ?></p>
			<a class="content-btn" href="<?php echo esc_url($terrifico_theme_options['third_column_url']); ?>"><?php _e('Read More','terrifico'); ?></a>
		</div>
	</div>
</div>
