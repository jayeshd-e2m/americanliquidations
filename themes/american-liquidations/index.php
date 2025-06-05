<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package American_Liquidations
 */

get_header();
?>

	<main id="primary" class="site-main">
		<?php $blog_page_id = get_option('page_for_posts'); ?>

		<?php if(get_field('display_section')){ ?>
			<?php if(get_field('pd_title',$blog_page_id ) || get_field('pd_description',$blog_page_id )){ ?>
				<div class="page-description-header py-12">
					<div class="container">
						<?php if(get_field('pd_title',$blog_page_id )){ ?><h1 class="text-[36px] md:text-[48px]"><?php echo get_field('pd_title',$blog_page_id ); ?></h1><?php } ?>
						<?php if(get_field('pd_description',$blog_page_id )){ ?><?php echo get_field('pd_description',$blog_page_id ); ?><?php } ?>
					</div>
				</div>
			<?php } ?>
		<?php } ?>
		<div class="bg-gray py-16 md:py-24">
			<div class="container">
			<?php
				if ( have_posts() ) :
					echo '<div class="grid grid-cols-2 lg:grid-cols-4 gap-5">';
					/* Start the Loop */
					while ( have_posts() ) :
						the_post(); ?>
						
						<div class="blog-items bg-white rounded-[15px]">
							<div class="blog-img pt-[70%] relative rounded-[15px] overflow-hidden">
								<a href="<?php echo get_the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
							</div>
							<div class="blog-content px-5 pt-10 pb-7 space-y-7">
								<h5><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h5>
								<div class="flex gap-4 items-center text-[#C8C8C8] text-sm justify-between">
									<?php echo get_the_date(); ?>
									<?php if(get_field('read_time')){ ?>
										<span class="font-barlow font-semibold text-[12px]"><?php echo get_field('read_time'); ?>min read</span>
									<?php } ?>
								</div>
								<?php 
								$content = get_the_content();
								$trimmed_content = wp_trim_words($content, 9, '...');
								echo '<p class="text-base leading-[1.2em]">' . $trimmed_content . '</p>';
								?>
								<a href="<?php echo get_the_permalink(); ?>" class="btn" style="width: 100%;">Learn More</a>
							</div>
						</div>

					<?php 
					endwhile;
					echo '</div>';
					the_posts_navigation();

				endif;
			?>
			</div>
		</div>		

	</main><!-- #main -->

<?php
get_footer();
