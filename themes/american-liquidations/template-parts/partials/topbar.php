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

<div aria-label="Top promotional links" class="bg-primary py-1.5">
    <div class="container flex items-center justify-between ">
        <a href="#" class="text-white text-sm hover:underline md:hidden">Visit Our Pallet Outlet in Waterbury, CT!</a>

        <span aria-hidden="true" class="mx-3 border-l border-white h-6 md:hidden"></span>

        <a href="#" class="text-white text-sm hover:underline md:hidden">Over 150 Pallets available</a>

        <span aria-hidden="true" class="mx-3 border-l border-white h-6 md:hidden"></span>

        <a href="#" class="text-white text-sm hover:underline md:hidden">Open to the Public 7 Days per week</a>

        <div class="wp-block-button is-style-fill has-color-style-secondary has-arrow has-force_hover__outline_secondary md:mx-auto is-small-on-md">
            <a class="wp-block-button__link wp-element-button " href="">GET DIRECTIONS</a>
        </div>
    </div>
</div>