<?php /* 
Name: FAQs Block
*/ ?>

<?php
$block_class = get_field('advanced') ? get_field('block_class') : '';
$block_id = get_field('advanced') ? get_field('block_id') : '';
?>

<section class="bg-gray py-14 lg:py-24 <?php echo esc_attr($block_class); ?>" <?php if ($block_id): ?>id="<?php echo esc_attr($block_id); ?>"<?php endif; ?>>
	<div class="container">
		<div class="faqs-items bg-white p-7 md:p-12 rounded-[15px] space-y-14">
			<?php
			if( have_rows('faqs_repeater') ):
				while( have_rows('faqs_repeater') ) : the_row(); ?>
					<div class="faq-item">
						<h6 class="text-[18px] font-semibold font-inter pr-5"><?php echo get_sub_field('question'); ?></h6>
						<div class="faq-answer">
							<div class="pt-12">
								<?php echo get_sub_field('answer'); ?>
							</div>
						</div> 
					</div>
				<?php endwhile;
			endif;
			?>
		</div>
	</div>

	<script>
		document.addEventListener('DOMContentLoaded', function () {
		const faqItems = document.querySelectorAll('.faq-item');

		faqItems.forEach(item => {
			const question = item.querySelector('h6');
			const answer = item.querySelector('.faq-answer');

			// Set initial styles
			answer.style.overflow = 'hidden';
			answer.style.maxHeight = '0';
			answer.style.transition = 'max-height 0.4s ease';

			question.addEventListener('click', () => {
			faqItems.forEach(otherItem => {
				const otherAnswer = otherItem.querySelector('.faq-answer');
				if (otherItem !== item) {
				otherItem.classList.remove('open');
				otherAnswer.style.maxHeight = '0';
				}
			});

			const isOpen = item.classList.contains('open');

			if (isOpen) {
				item.classList.remove('open');
				answer.style.maxHeight = '0';
			} else {
				item.classList.add('open');
				answer.style.maxHeight = answer.scrollHeight + 'px';
			}
			});
		});
		});

	</script>

</section>