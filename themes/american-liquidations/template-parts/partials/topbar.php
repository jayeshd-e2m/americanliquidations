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
$link_classes = 'text-white text-sm hover:underline ';
?>

<div aria-label="Top promotional links" class="bg-primary py-1.5">
    <div class="container">
        <div class="flex items-center justify-between">
            <a href="#" class="text-white text-sm hover:underline ">Visit Our Pallet Outlet in Waterbury, CT!</a>

            <span aria-hidden="true" class="mx-3 border-l border-white h-6 "></span>

            <a href="#" class="text-white text-sm hover:underline ">Over 150 Pallets available</a>

            <span aria-hidden="true" class="mx-3 border-l border-white h-6 "></span>

            <a href="#" class="text-white text-sm hover:underline ">Open to the Public 7 Days per week</a>

            <div>
                <a class="btn" href="">GET DIRECTIONS</a>
            </div>
        </div>
    </div>
</div>