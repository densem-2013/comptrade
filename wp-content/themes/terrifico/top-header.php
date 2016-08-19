<?php
/**
 * @package Terrifico
 */
$terrifico_theme_options = terrifico_get_options( 'terrifico_theme_options' );
?>
<div id="header-top">
	<div class="pagetop-inner clearfix">
		<div class="top-left left">
			<span class="top-phone"><i class="fa fa-phone"></i><?php echo esc_attr($terrifico_theme_options['header_phone']); ?></span>
			<span class="top-email"><i class="fa fa-envelope"></i><a href="mailto:<?php echo esc_attr($terrifico_theme_options['header_email']); ?>"><?php echo esc_attr($terrifico_theme_options['header_email']); ?></a></span>
		</div>
		<div class="top-right right">
			<?php if ( $terrifico_theme_options['header_social_enable'] == '1' ) { get_template_part( 'social','header' ); }; ?>
		</div>
	</div>
</div>