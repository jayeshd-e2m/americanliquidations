<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package American_Liquidations
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<div class="page-description-header py-12">
				<div class="container">
					<h1 class="text-[36px] md:text-[48px]">404</h1>
					<p>The page you are looking for can not be found</p>
					<div class="">
						<a class="btn btn-red" href="/" target="_self">Return to Homepage</a>
					</div>

				</div>
			</div>
		</section>
	</main><!-- #main -->

<?php
get_footer();
