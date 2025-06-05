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
		<div class="page-description-header py-12">
			<div class="container">
				<h1 class="text-[36px] md:text-[48px]">404 Page</h1>
			</div>
		</div>
		<div class="py-16 bg-gray">
			<div class="container">
			<h2 class="mb-3">Page Not Found</h2>
			<p><strong>The page you requested cannot be found. The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</strong> </p>

			<h4 class="mt-6">Please try the following:</h4>
			<ul class="mt-4" style="list-style: disc;margin-left: 20px;">
				<li>If you typed the page address in the Address bar, make sure that it is spelled correctly.</li>
				<li>Open the home page and look for links to the information you want.</li>
				<li>Use the navigation bar on the left or top to find the link you are looking for.</li>
				<li>Click the back button to try another link.</li>
			</ul> 
			<a href="<?php echo site_url(); ?>" class="btn btn-red btn-small mt-5">Go to Home</a>
		</div>
		</div>
	</main>

<?php
get_footer();
