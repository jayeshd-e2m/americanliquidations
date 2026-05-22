<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package American_Liquidations
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if(get_field('display_section') && !is_cart()){ ?>
		<div class="page-description-header py-12 zzz">
			<div class="container">
				<?php if(get_field('pd_title')){ ?><h1 class="text-[36px] md:text-[44px] lg:text-[48px]"><?php echo get_field('pd_title'); ?></h1><?php } ?>
				<?php if(get_field('pd_description')){ ?>
					<div class="mt-6">
						<p><?php if(get_field('pd_description')){ ?><?php echo get_field('pd_description'); ?><?php } ?></p>
					</div>
				<?php } ?>
				<?php 
				$link = get_field('pd_button');
				if( $link ): 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<div class="mt-6">
						<a class="btn btn-arrow btn-red" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php } ?>
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
