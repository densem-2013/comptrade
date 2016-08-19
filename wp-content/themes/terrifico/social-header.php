<?php
/**
 * @package Terrifico
 */
$terrifico_theme_options = terrifico_get_options( 'terrifico_theme_options' );
?>			
<div id="social-bar-header">
	<ul>
		<?php if($terrifico_theme_options['facebook_link']): ?>
		<li>
			<a href="<?php echo esc_url($terrifico_theme_options['facebook_link']); ?>" target="_blank" title="<?php _e('Facebook','terrifico'); ?>"><i class="fa fa-facebook"></i></a>
		</li>
		<?php endif; ?>
		<?php if($terrifico_theme_options['twitter_link']): ?>
		<li>
			<a href="<?php echo esc_url($terrifico_theme_options['twitter_link']); ?>" target="_blank" title="<?php _e('Twitter','terrifico'); ?>"><i class="fa fa-twitter"></i></a>
		</li>
		<?php endif; ?>
		<?php if($terrifico_theme_options['google_link']): ?>
		<li>
			<a href="<?php echo esc_url($terrifico_theme_options['google_link']); ?>" target="_blank" title="<?php _e('Google+','terrifico'); ?>"><i class="fa fa-google-plus"></i></a>
		</li>
		<?php endif; ?>
		<?php if($terrifico_theme_options['linkedin_link']): ?>
		<li>
			<a href="<?php echo esc_url($terrifico_theme_options['linkedin_link']); ?>" target="_blank" title="<?php _e('LinkedIn','terrifico'); ?>"><i class="fa fa-linkedin"></i></a>
		</li>
		<?php endif; ?>
		<?php if($terrifico_theme_options['instagram_link']): ?>
		<li>
			<a href="<?php echo esc_url($terrifico_theme_options['instagram_link']); ?>" target="_blank" title="<?php _e('Instagram','terrifico'); ?>"><i class="fa fa-instagram"></i></a>
		</li>
		<?php endif; ?>
	</ul>
</div><!--social-bar-->