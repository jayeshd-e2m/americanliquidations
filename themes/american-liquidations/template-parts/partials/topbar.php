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

<div aria-label="Top promotional links" class="bg-primary py-[10px]"> 
    <div class="container">
        <div class="flex items-center justify-center lg:justify-between"> 
            <div class="text-white text-sm font-barlow font-bold hidden lg:block"><?php echo get_field('heading_1','option'); ?></div>

            <span aria-hidden="true" class="mx-3 border-l border-white h-6 hidden lg:block"></span>

            <div class="text-white text-sm font-barlow font-bold hidden lg:block"><?php echo get_field('heading_2','option'); ?></div>

            <span aria-hidden="true" class="mx-3 border-l border-white h-6 hidden lg:block"></span>

            <div class="text-white text-sm font-barlow font-bold hidden lg:block"><?php echo get_field('heading_3','option'); ?></div>

            <div>
                <?php 
                $link = get_field('top_button','option');
                if( $link ): 
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <a class="btn btn-small btn-arrow hover:text-white hover:bg-transparent hover:border-white" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>