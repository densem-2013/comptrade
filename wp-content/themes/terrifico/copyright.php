<?php
/**
 * @package Terrifico
 */  
$terrifico_theme_options = terrifico_get_options( 'terrifico_theme_options' );
?>
<div id="copyright">
	<div class="copyright-wrap">
		<span class="left"><a href="<?php echo esc_url( home_url( '/' ) ) ?>"><?php echo esc_attr($terrifico_theme_options['footer_copyright_text']);?></a></span>
		<span class="right"><a title="<?php _e('Terrifico Theme','terrifico'); ?>" target="_blank" href="<?php echo esc_url( __('http://vpthemes.com/terrifico/','terrifico') );?>"><?php _e('Terrifico Theme','terrifico'); ?></a><?php _e(' powered by ','terrifico'); ?><a title="<?php _e('WordPress','terrifico'); ?>" href="<?php echo esc_url( __( 'https://wordpress.org/', 'terrifico' ) ); ?>"><?php _e('WordPress','terrifico'); ?></a></span>
	</div>
</div><!--copyright-->