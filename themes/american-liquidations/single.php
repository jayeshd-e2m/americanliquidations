<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package American_Liquidations
 */

get_header();
?>

	<?php while ( have_posts() ) : the_post();
	?>
	<main id="primary" class="site-main">
		<?php 
		$thumbnail = get_the_post_thumbnail_url(); 
		if(!$thumbnail){
			$thumbnail = site_url().'/wp-content/uploads/2025/05/amrican-no-imge.jpg';
			
		}
		?>
		<div class="blog-single-thumbnail py-[60px] md:py-[110px]" style="background-image: url(<?php echo $thumbnail; ?>); background-size: cover;">
			<div class="container relative">
				<div class="max-w-[850px] space-y-5">
					<h1 class="!text-[36px] md:!text-[48px] text-white"><?php the_title(); ?></h1>
					<div class="flex gap-12 items-center text-lg text-primary font-barlow font-medium">
						<?php echo get_the_date(); ?>
						<?php if(get_field('read_time',get_the_ID())){ ?>
							<span class="font-barlow font-semibold text-lg text-primary"><?php echo get_field('read_time',get_the_ID()); ?>min read</span>
						<?php } ?>
					</div>
					<div class="text-white/60 font-medium"><?php echo wp_trim_words( get_the_excerpt(), 10, '...' ); ?></div>
				</div>
			</div>
		</div>
		<div class="py-14 md:py-24 body-content">
			<div class="container">
				<div class="max-w-[935px] mx-auto">
					<?php
						the_content();		
					?>
				</div>
			</div>
		</div>

	</main>
<?php endwhile; ?>
<?php
// get_sidebar();
get_footer();
