<?php /* 
Name: FAQs Block
*/ ?>

<?php
$block_class = get_field('advanced') ? get_field('block_class') : '';
$block_id = get_field('advanced') ? get_field('block_id') : '';
?>

<section class="bg-gray py-14 lg:py-24 <?php echo esc_attr($block_class); ?>" <?php if ($block_id): ?>id="<?php echo esc_attr($block_id); ?>"<?php endif; ?>>
	<div class="container">
		<div class="faqs-items bg-white px-7 md:px-12 py-12 rounded-[15px] space-y-14">
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

		faqItems.forEach((item, index) => {
			const question = item.querySelector('h6');
			const answer = item.querySelector('.faq-answer');

			answer.style.overflow = 'hidden';
			answer.style.transition = 'max-height 0.4s ease';

			// Open first FAQ
			if (index === 0) {
				item.classList.add('open');
				answer.style.maxHeight = answer.scrollHeight + 'px';
			} else {
				answer.style.maxHeight = '0';
			}

			question.addEventListener('click', () => {
				const isOpen = item.classList.contains('open');

				// If it's already open, do nothing (prevents closing it)
				if (isOpen) return;

				// Close all and open the clicked one
				faqItems.forEach(otherItem => {
					const otherAnswer = otherItem.querySelector('.faq-answer');
					otherItem.classList.remove('open');
					otherAnswer.style.maxHeight = '0';
				});

				item.classList.add('open');
				answer.style.maxHeight = answer.scrollHeight + 'px';
			});
		});
	});
	</script>


</section>