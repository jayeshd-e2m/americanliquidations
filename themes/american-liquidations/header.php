<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package American_Liquidations
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'american-liquidations' ); ?></a>

	<header id="amliq-header" class="site-header relative z-30" role="banner" aria-label="<?php esc_attr_e( 'Site Header', 'amliq_theme' ); ?>">
        <?php
        /** 
         * Output the topbar.
         * 
         * Uses template-parts/header/topbar.php
         *
         * @return void
         */
        get_template_part( 'templates/partials/topbar' );

        ?>
        <?php
        /** 
         * Output the header.
         * 
         * Uses template-parts/header/header.php
         *
         * @return void
         */
        get_template_part( 'templates/partials/header' );
        ?>
    </header><!-- #masthead -->
