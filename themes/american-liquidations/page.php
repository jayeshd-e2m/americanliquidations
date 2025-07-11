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
			</div>
		</div>
		<?php } ?>

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
