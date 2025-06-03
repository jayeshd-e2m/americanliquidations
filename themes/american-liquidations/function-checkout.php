<?php

// Checkout

remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

add_action( 'woocommerce_after_checkout_billing_form', 'custom_move_payment_section', 10 );

function custom_move_payment_section() {
    echo '<div class="custom-checkout-payment">';
    // This outputs payment gateways and the Place Order button (with all hooks etc)
    woocommerce_checkout_payment();
    echo '</div>';
}


add_filter( 'woocommerce_checkout_fields', 'custom_reorder_checkout_fields' );
function custom_reorder_checkout_fields( $fields ) {
    // Set desired order ('priority') for each field

    // First: Email
    $fields['billing']['billing_email']['priority'] = 1;

    // Address fields (grouped after email)
    $fields['billing']['billing_first_name']['priority'] = 10;
    $fields['billing']['billing_last_name']['priority'] = 20;
    $fields['billing']['billing_address_1']['priority'] = 30;
    $fields['billing']['billing_address_2']['priority'] = 40;
    $fields['billing']['billing_country']['priority'] = 50;
    $fields['billing']['billing_city']['priority'] = 60;
    $fields['billing']['billing_state']['priority'] = 70;
    $fields['billing']['billing_postcode']['priority'] = 80;

    // Then: Phone at the end
    $fields['billing']['billing_phone']['priority'] = 100;

    // If you want to remove the company field or other fields, uncomment below:
    // unset($fields['billing']['billing_company']);

    return $fields;
}

add_filter( 'woocommerce_checkout_fields', function ( $fields ) {
    // Remove label, add placeholder for each billing field:
    $fields['billing']['billing_first_name']['label'] = '';
    $fields['billing']['billing_first_name']['placeholder'] = 'First name';

    $fields['billing']['billing_last_name']['label'] = '';
    $fields['billing']['billing_last_name']['placeholder'] = 'Last name';

    $fields['billing']['billing_address_1']['label'] = '';
	$fields['billing']['billing_address_1']['placeholder'] = 'Address';

    $fields['billing']['billing_address_2']['label'] = '';
    $fields['billing']['billing_address_2']['placeholder'] = 'Apt, Suite, etc.';

    $fields['billing']['billing_country']['label'] = '';
    $fields['billing']['billing_country']['placeholder'] = 'Country';

    $fields['billing']['billing_city']['label'] = '';
    $fields['billing']['billing_city']['placeholder'] = 'City';

    $fields['billing']['billing_state']['label'] = '';
    $fields['billing']['billing_state']['placeholder'] = 'State';

    $fields['billing']['billing_postcode']['label'] = '';
    $fields['billing']['billing_postcode']['placeholder'] = 'Zip Code';
    

    return $fields;
});

add_filter('woocommerce_checkout_fields', function ($fields) {
    // Make city and state half-width
    $fields['billing']['billing_city']['class'] = ['form-row-first'];
    $fields['billing']['billing_state']['class'] = ['form-row-last'];

    return $fields;
});


add_action( 'wp_footer', function() {
    if (is_checkout()) {
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const target = document.querySelector('input[name="billing_address_1"]');
				if (!target) return;

				const setPlaceholder = () => {
					if (target.placeholder !== 'Address') {
						target.placeholder = 'Address';
					}
				};

				// Set initially
				setPlaceholder();

				// Observe changes to attributes
				const observer = new MutationObserver(setPlaceholder);

				observer.observe(target, {
					attributes: true,
					attributeFilter: ['placeholder']
				});


				function applyCityStateLayout() {
					const cityRow = document.querySelector('p#billing_city_field');
					const stateRow = document.querySelector('p#billing_state_field');

					if (cityRow && stateRow) {
						cityRow.classList.remove('form-row-wide');
						cityRow.classList.add('form-row-first');

						stateRow.classList.remove('form-row-wide');
						stateRow.classList.add('form-row-last');
					}
				}

				applyCityStateLayout();

				// Observe changes in the checkout form (due to country/state updates etc.)
				const checkoutForm = document.querySelector('form.checkout');
				if (checkoutForm) {
					const observer = new MutationObserver(applyCityStateLayout);
					observer.observe(checkoutForm, { childList: true, subtree: true });
				}


                const target_2 = document.querySelector('input[name="billing_address_2"]');
                if (!target_2) return;

                const setPlaceholder_2 = () => {
                    if (target_2.placeholder !== 'Apt, Suite, etc.') {
                        target_2.placeholder = 'Apt, Suite, etc.';
                    }
                };

                setPlaceholder_2();

                const observer_2 = new MutationObserver(setPlaceholder_2);
                observer_2.observe(target_2, {
                    attributes: true,
                    attributeFilter: ['placeholder']
                });

            });
        </script>
        <?php
    }
});

?>