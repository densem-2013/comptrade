<?php
/**
 * @package Terrifico
 */ 
$terrifico_theme_options = terrifico_get_options( 'terrifico_theme_options' );
?>
<div id="get-started">
	<div id="get-strated-wrap">
		<div class="get-strated-left left">
			<h2 class="no-margin no-padding normal"><?php echo esc_attr($terrifico_theme_options['getst_section_header']); ?></h2>
		</div>
		<div class="get-strated-left right">
			<span class="no-margin no-padding normal"> <?php echo esc_attr($terrifico_theme_options['getst_section_text']); ?></span>
			<a class="get-strated-button" href="<?php echo esc_url($terrifico_theme_options['getst_button_url']); ?>"><?php echo esc_attr($terrifico_theme_options['getst_button_text']); ?></a>
		</div>
	</div><!--get-started-wrap-->
</div><!--get-started-->