<?php
/**
 * Topbar template part.
 *
 * Shows a slim promo bar with links and a CTA button.
 *
 * @package Amliq
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Common link classes
$link_classes = 'text-white text-sm hover:underline md:hidden';
?>

<div aria-label="<?php echo esc_attr( __( 'Top promotional links', 'amliq' ) ); ?>" class="bg-primary-700 py-1.5">
    <div class="container flex items-center justify-between ">
        <a href="#" class="<?php echo esc_attr( $link_classes ); ?>">
            <?php echo esc_html__( 'Visit Our Pallet Outlet in Waterbury, CT!', 'amliq' ); ?>
        </a>

        <span aria-hidden="true" class="mx-3 border-l border-white h-6 md:hidden"></span>

        <a href="#" class="<?php echo esc_attr( $link_classes ); ?>">
            <?php echo esc_html__( 'Over 150 Pallets available', 'amliq' ); ?>
        </a>

        <span aria-hidden="true" class="mx-3 border-l border-white h-6 md:hidden"></span>

        <a href="#" class="<?php echo esc_attr( $link_classes ); ?>">
            <?php echo esc_html__( 'Open to the Public 7 Days per week', 'amliq' ); ?>
        </a>

        <?php
        get_template_part(
            'templates/partials/button',
            '',
            [
                'text'  => __( 'GET DIRECTIONS', 'amliq' ),
                'href'  => '#',
                'class' => 'is-style-fill has-color-style-secondary has-arrow has-force_hover__outline_secondary md:mx-auto is-small-on-md',
                'link_class' => '',
            ]
        );
        ?>
    </div>
</div>
