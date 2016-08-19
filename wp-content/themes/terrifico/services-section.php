<?php
/**
 * @package Terrifico
 */
$terrifico_theme_options = terrifico_get_options( 'terrifico_theme_options' );
$services_bg_image = $terrifico_theme_options['services_bg_image'];

if ($services_bg_image !='') { ?>
	<div id="services" style="background: url(<?php echo esc_url($services_bg_image); ?>) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
<?php } else { ?>
	<div id="services">
<?php } ?>
	<div id="services-wrap">
		<div class="services">
			<h2 class="boxtitle wow bounceInLeft" data-wow-delay="0.1s"><?php echo esc_attr($terrifico_theme_options['services_section_title']); ?></h2>
			<p class="wow bounceInRight" data-wow-delay="0.2s"><?php echo esc_attr($terrifico_theme_options['services_section_desc']); ?></p>
			<div class="service-boxes">
				<div class="service-box wow bounceIn" data-wow-delay="0.2s">
					<a class="service-icon" href="<?php echo esc_url($terrifico_theme_options['service_one_url']); ?>">
						<i class="fa <?php echo esc_attr($terrifico_theme_options['service_one_icon']); ?>"></i>
					</a>
					<p class="service-header"><?php echo esc_attr($terrifico_theme_options['service_one']); ?></p>
				</div>
				<div class="service-box wow bounceIn" data-wow-delay="0.4s"">
					<a class="service-icon" href="<?php echo esc_url($terrifico_theme_options['service_two_url']); ?>">
						<i class="fa <?php echo esc_attr($terrifico_theme_options['service_two_icon']); ?>"></i>
					</a>
					<p class="service-header"><?php echo esc_attr($terrifico_theme_options['service_two']); ?></p>
				</div>
				<div class="service-box wow bounceIn" data-wow-delay="0.6s"">
					<a class="service-icon" href="<?php echo esc_url($terrifico_theme_options['service_three_url']); ?>">
						<i class="fa <?php echo esc_attr($terrifico_theme_options['service_three_icon']); ?>"></i>
					</a>
					<p class="service-header"><?php echo esc_attr($terrifico_theme_options['service_three']); ?></p>
				</div>
				<div class="service-box wow bounceIn" data-wow-delay="0.8s"">
					<a class="service-icon" href="<?php echo esc_url($terrifico_theme_options['service_four_url']); ?>">
						<i class="fa <?php echo esc_attr($terrifico_theme_options['service_four_icon']); ?>"></i>
					</a>
					<p class="service-header"><?php echo esc_attr($terrifico_theme_options['service_four']); ?></p>
				</div>
				<div class="service-box wow bounceIn" data-wow-delay="1.0s"">
					<a class="service-icon" href="<?php echo esc_url($terrifico_theme_options['service_five_url']); ?>">
						<i class="fa <?php echo esc_attr($terrifico_theme_options['service_five_icon']); ?>"></i>
					</a>
					<p class="service-header"><?php echo esc_attr($terrifico_theme_options['service_five']); ?></p>
				</div>
				<div class="service-box wow bounceIn" data-wow-delay="1.2s"">
					<a class="service-icon" href="<?php echo esc_url($terrifico_theme_options['service_six_url']); ?>">
						<i class="fa <?php echo esc_attr($terrifico_theme_options['service_six_icon']); ?>"></i>
					</a>
					<p class="service-header"><?php echo esc_attr($terrifico_theme_options['service_six']); ?></p>
				</div>
			</div>
		</div>
	</div><!--services-wrap-->
</div><!--services-->