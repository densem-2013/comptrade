<?php
/**
 * The template for displaying the footer.
 *
 *
 * @package Terrifico
 */ 
$terrifico_theme_options = terrifico_get_options( 'terrifico_theme_options' );?>
	<div class="clear"></div>
	<div id="footer">
	<?php if ( $terrifico_theme_options['footer_widgets'] == '1') { ?>
		<div id="footer-wrap">
			<?php  get_sidebar('footer'); ?>
		</div><!--footer-wrap-->
	<?php } ?>
	</div><!--footer-->
	<?php get_template_part( 'copyright' ); ?>
</div><!--grid-container-->
<?php wp_footer(); ?>
</body>
</html>