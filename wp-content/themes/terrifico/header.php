<?php
/**
 * The Header of the theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
 * @package terrifico
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="grid-container">
	<div class="clear"></div>
		<?php $terrifico_theme_options = terrifico_get_options( 'terrifico_theme_options' );
		if ($terrifico_theme_options['header_top_enable'] == '1') {
			get_template_part( 'top', 'header' );
		} ?>
		<?php if (get_header_image()!='') { ?>
			<div id="header-holder" style="background: url(<?php echo esc_url(header_image()); ?>) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
		<?php } else { ?>
			<div id="header-holder">
		<?php } ?>
			<div id ="header-wrap">
				<div class="menu-wrap">
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<div id="logo">
							<?php if ( $terrifico_theme_options['logo'] != '' ) { ?>
								<a href="<?php echo esc_url( home_url( '/' ) ) ?>"><img src="<?php echo esc_url($terrifico_theme_options['logo']); ?>" alt="<?php echo esc_attr($terrifico_theme_options['logo_alt_text']); ?>"/></a>
								<?php if ($terrifico_theme_options['enable_logo_tagline'] == '1' ) { ?> 
									<h5 class="site-description"><?php echo esc_attr(bloginfo('description')); ?></h5>
								<?php } ?>
							<?php } else { ?>
								<a href="<?php echo esc_url( home_url( '/' ) ) ?>"><?php esc_attr(bloginfo( 'name' )); ?></a>
								<?php if ($terrifico_theme_options['enable_logo_tagline'] == '1' ) { ?> 
									<h5 class="site-description"><?php echo esc_attr(bloginfo('description')); ?></h5>
								<?php } ?>
							<?php } ?>
						</div>
						<?php wp_nav_menu(array('theme_location' => 'main_navigation', 'container' => false,'menu_id'=>'menu-main-navigation','menu_class' => 'sf-menu sf-js-enabled sf-shadow', 'fallback_cb'=> 'wp_page_menu', )); ?>
					</nav><!--site-navigation-->
				</div><!--logo-->
			</div><!--header-wrap-->
		</div><!--header-holder-->