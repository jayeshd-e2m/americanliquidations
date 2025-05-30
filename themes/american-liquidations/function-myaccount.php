<?php

// Account pages

// Update Legal Name AJAX
add_action('wp_ajax_edit_legal_name', function() {
    $user_id = intval($_POST['user_id']);
    if(get_current_user_id() != $user_id) wp_send_json_error('No permission');
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $middle_name = sanitize_text_field($_POST['middle_name']);
    wp_update_user([
        'ID' => $user_id,
        'first_name' => $first_name,
        'last_name' => $last_name
    ]);
    update_user_meta($user_id, 'middle_name', $middle_name);
    wp_send_json_success();
});

// Update Email AJAX
add_action('wp_ajax_edit_user_email', function() {
    $user_id = intval($_POST['user_id']);
    if(get_current_user_id() != $user_id) wp_send_json_error('No permission');
    $email = sanitize_email($_POST['user_email']);
    if(!is_email($email)) wp_send_json_error('Invalid email');
    wp_update_user([
        'ID' => $user_id,
        'user_email' => $email
    ]);
    wp_send_json_success();
});

// Update Phone Number AJAX
add_action('wp_ajax_edit_user_phone', function() {
    $user_id = intval($_POST['user_id']);
    if (get_current_user_id() !== $user_id) {
        wp_send_json_error('No permission');
    }

    $phone = sanitize_text_field($_POST['user_phone']);
    update_user_meta($user_id, 'user_phone', $phone);

    wp_send_json_success();
});




// Add Middle Name field to user profile in admin
add_action( 'show_user_profile', 'add_middle_name_field_to_user_profile' );
add_action( 'edit_user_profile', 'add_middle_name_field_to_user_profile' );

function add_middle_name_field_to_user_profile( $user ) {
    ?>
    <h3>Extra Profile Information</h3>
    <table class="form-table">
        <tr>
            <th><label for="middle_name">Middle Name</label></th>
            <td>
                <input type="text" name="middle_name" id="middle_name" value="<?php echo esc_attr( get_user_meta( $user->ID, 'middle_name', true ) ); ?>" class="regular-text" /><br />
                <span class="description">Please enter the user&rsquo;s middle name.</span>
            </td>
        </tr>
    </table>
    <?php
}

// Save the middle name when the user profile is updated
add_action( 'personal_options_update', 'save_middle_name_field' );
add_action( 'edit_user_profile_update', 'save_middle_name_field' );

function save_middle_name_field( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    update_user_meta( $user_id, 'middle_name', sanitize_text_field( $_POST['middle_name'] ) );
}


add_action('wp_ajax_edit_user_password', function() {
    $user_id = intval($_POST['user_id']);
    if(get_current_user_id() != $user_id) wp_send_json_error('No permission');

    $password = trim($_POST['new_password']);
    $confirm = trim($_POST['confirm_password']);

    if(strlen($password) < 6) wp_send_json_error("Password too short");
    if($password !== $confirm) wp_send_json_error("Passwords do not match");

    // Update password
    wp_set_password($password, $user_id);
    wp_send_json_success();
});



// 2FA

// add_action( 'wp_ajax_toggle_2fa_setting', function() {
//     $user_id = get_current_user_id();
//     if (!$user_id) wp_send_json_error('Not logged in');

//     $enable_2fa = $_POST['enable_2fa'] === 'yes' ? 'yes' : 'no';
//     update_user_meta($user_id, 'user_2fa_enabled', $enable_2fa);

//     wp_send_json_success();
// });

// add_filter('authenticate', function($user, $username, $password){
    // if (is_a($user, 'WP_User')) {
    //     $is_2fa = get_user_meta($user->ID, 'user_2fa_enabled', true) === 'yes';
    //     if ($is_2fa) {
    //         // Generate 6 digit code
    //         $code = rand(100000, 999999);
    //         update_user_meta($user->ID, 'user_2fa_code', $code);
    //         update_user_meta($user->ID, 'user_2fa_expires', time() + 300); // 5 mins expiry

    //         // SEND SMS: (example, use your SMS provider)
    //         $phone = get_user_meta($user->ID, 'user_phone', true);
    //         my_send_sms($phone, "Your login code: $code");

    //         // Save info in session to check after
    //         $_SESSION['pending_2fa_user'] = $user->ID;

    //         // Instead of logging in, redirect to 2FA verification page
    //         wp_redirect( site_url('/2fa-verification/') ); // Make this page!
    //         exit;
    //     }
    // }
    // return $user;
// }, 99, 3);





// Business Account

add_filter('woocommerce_account_menu_items', function($items) {
    $new = [];
    foreach ($items as $k=>$v) {
        $new[$k] = $v;
        if ($k === 'edit-account') {
            $new['business-profile'] = __('Business Profile', 'woocommerce');
        }
    }
    return $new;
});
add_action('init', function() {
    add_rewrite_endpoint('business-profile', EP_ROOT | EP_PAGES);
});
add_action('woocommerce_account_business-profile_endpoint', function() {
    wc_get_template('myaccount/form-edit-business.php');
});


// display business profile in backend

// 1. SHOW FIELDS ON USER PROFILE
add_action('show_user_profile', 'my_show_business_profile_fields');
add_action('edit_user_profile', 'my_show_business_profile_fields');

function my_show_business_profile_fields($user) {
    $business_name    = get_user_meta($user->ID, 'business_name', true);
    $business_ein     = get_user_meta($user->ID, 'business_ein', true);
    $business_phone   = get_user_meta($user->ID, 'business_phone', true);
    $business_address = get_user_meta($user->ID, 'business_address', true);
    $business_type    = get_user_meta($user->ID, 'business_type', true);
    $tax_document_id  = get_user_meta($user->ID, 'tax_document_id', true);
    $tax_document_url = $tax_document_id ? wp_get_attachment_url($tax_document_id) : '';
    ?>
    <h2>Business Profile</h2>
    <table class="form-table">
        <tr>
            <th><label for="business_name">Business Name</label></th>
            <td>
                <input type="text" name="business_name" id="business_name" value="<?php echo esc_attr($business_name); ?>" class="regular-text" /><br />
            </td>
        </tr>
        <tr>
            <th><label for="business_ein">Employer Identification Number (EIN)</label></th>
            <td>
                <input type="text" name="business_ein" id="business_ein" value="<?php echo esc_attr($business_ein); ?>" class="regular-text" /><br />
            </td>
        </tr>
        <tr>
            <th><label for="business_phone">Business Phone Number</label></th>
            <td>
                <input type="text" name="business_phone" id="business_phone" value="<?php echo esc_attr($business_phone); ?>" class="regular-text" /><br />
            </td>
        </tr>
        <tr>
            <th><label for="business_address">Business Address</label></th>
            <td>
                <textarea name="business_address" id="business_address" class="regular-text" rows="3"><?php echo esc_textarea($business_address); ?></textarea><br />
            </td>
        </tr>
        <tr>
            <th><label for="business_type">Business Type</label></th>
            <td>
                <input type="text" name="business_type" id="business_type" value="<?php echo esc_attr($business_type); ?>" class="regular-text" /><br />
            </td>
        </tr>
        <tr>
            <th><label for="tax_document_id">Tax Exempt Document</label></th>
            <td>
                <?php if ($tax_document_url): ?>
                    <?php
                    $mime_type = get_post_mime_type($tax_document_id);
                    $file_name = basename(get_attached_file($tax_document_id));
                    ?>
                    <div style="margin-bottom:8px;">
                        <?php if ($mime_type === 'application/pdf'): ?>
                            <iframe src="<?php echo esc_url($tax_document_url); ?>#toolbar=0" width="100%" height="400" style="border:1px solid #ccc;border-radius:6px;"></iframe><br/>
                        <?php elseif (strpos($mime_type, 'image/') === 0): ?>
                            <img src="<?php echo esc_url($tax_document_url); ?>" alt="Uploaded document" style="max-width:240px; max-height:240px; border:1px solid #ccc; border-radius:6px;" /><br/>
                        <?php endif; ?>
                        <a href="<?php echo esc_url($tax_document_url); ?>" target="_blank" style="display:inline-block;margin-top:4px;"><?php echo esc_html($file_name); ?> (View/Download)</a>
                    </div>
                <?php else: ?>
                    <span style="color:#888">No document uploaded by user.</span><br/>
                <?php endif; ?>
                <input type="file" name="tax_document" id="tax_document" accept="application/pdf,image/*" /><br/>
                <small>Uploading a new file will replace the old one.</small>
            </td>
        </tr>
    </table>
    <?php 
}

// 2. SAVE FIELDS FROM USER PROFILE FORM
add_action('personal_options_update', 'my_save_business_profile_fields');
add_action('edit_user_profile_update', 'my_save_business_profile_fields');

function my_save_business_profile_fields($user_id) {
    if (!current_user_can('edit_user', $user_id)) return false;
    update_user_meta($user_id, 'business_name', sanitize_text_field($_POST['business_name']));
    update_user_meta($user_id, 'business_ein', sanitize_text_field($_POST['business_ein']));
    update_user_meta($user_id, 'business_phone', sanitize_text_field($_POST['business_phone']));
    update_user_meta($user_id, 'business_address', sanitize_textarea_field($_POST['business_address']));
    update_user_meta($user_id, 'business_type', sanitize_text_field($_POST['business_type']));

    // Handle file upload for admin
    if (isset($_FILES['tax_document']) && !empty($_FILES['tax_document']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        $uploaded = wp_handle_upload($_FILES['tax_document'], array('test_form' => false));
        if (empty($uploaded['error'])) {
            // Attach to user, save ID
            $attach_id = wp_insert_attachment([
                'post_mime_type' => $uploaded['type'],
                'post_title'     => basename($uploaded['file']),
                'post_content'   => '',
                'post_status'    => 'inherit'
            ], $uploaded['file']);
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            wp_update_attachment_metadata($attach_id, wp_generate_attachment_metadata($attach_id, $uploaded['file']));
            update_user_meta($user_id, 'tax_document_id', $attach_id);
        }
    }
}




// Address book

add_action('init', function () {
    add_rewrite_endpoint('address-book', EP_ROOT | EP_PAGES);
});

add_filter('query_vars', function ($vars) {
    $vars[] = 'address-book';
    return $vars;
});

add_filter('woocommerce_account_menu_items', function ($items) {
    $items['address-book'] = 'Address Book';
    return $items;
}, 99);

add_action('woocommerce_account_address-book_endpoint', function () {
    get_template_part('woocommerce/myaccount/form-address-book');
});


add_action('wp_ajax_save_custom_address', 'save_custom_address_callback');
function save_custom_address_callback() {
    $user_id = get_current_user_id();

    if (!$user_id) {
        wp_send_json_error();
    }

    $address = array(
        'address'            => sanitize_text_field($_POST['address']),
        'city'               => sanitize_text_field($_POST['city']),
        'zipcode'            => sanitize_text_field($_POST['zipcode']),
        'country'            => sanitize_text_field($_POST['country']),
        'zone'               => sanitize_text_field($_POST['zone']),
        'storage_facility'   => sanitize_text_field($_POST['storage_facility']),
        'liftgate'           => sanitize_text_field($_POST['liftgate']),
        'can_receive_truck'  => sanitize_text_field($_POST['can_receive_truck']),
    );

    $addresses = get_user_meta($user_id, 'custom_addresses', true);
    $addresses = is_array($addresses) ? $addresses : [];

    $addresses[] = $address;

    update_user_meta($user_id, 'custom_addresses', $addresses);

    wp_send_json_success();
}


add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('jquery'); // Needed for most WooCommerce themes
});

add_action('wp_ajax_delete_custom_address', 'delete_custom_address_callback');
function delete_custom_address_callback() {
    $user_id = get_current_user_id();

    if (!$user_id || !isset($_POST['index'])) {
        wp_send_json_error();
    }

    $index = intval($_POST['index']);
    $addresses = get_user_meta($user_id, 'custom_addresses', true);
    $addresses = is_array($addresses) ? $addresses : [];

    if (isset($addresses[$index])) {
        unset($addresses[$index]);
        $addresses = array_values($addresses); // Reindex array
        update_user_meta($user_id, 'custom_addresses', $addresses);
        wp_send_json_success();
    }

    wp_send_json_error();
}




// Add fields in backend

// function show_custom_addresses_in_profile($user) {
//     $addresses = get_user_meta($user->ID, 'custom_addresses', true);
//     $addresses = is_array($addresses) ? $addresses : [];

//     echo '<h2>Custom Address Book</h2>';
//     echo '<table class="form-table">';

//     if (!empty($addresses)) {
//         foreach ($addresses as $i => $address) {
//             echo '<tr><th>Address ' . ($i + 1) . '</th><td>';
//             echo '<strong>' . esc_html($address['address'] ?? '---') . '</strong><br>';
//             echo esc_html($address['city'] ?? '---') . ', ' . esc_html($address['zipcode'] ?? '---') . '<br>';
//             echo esc_html($address['country'] ?? '---') . ' - ' . esc_html($address['zone'] ?? '---') . '<br>';
//             echo 'Storage Facility: ' . esc_html($address['storage_facility'] ?? '---') . '<br>';
//             echo 'Liftgate Required: ' . esc_html($address['liftgate'] ?? '---') . '<br>';
//             echo 'Can Receive 53\' Trucks: ' . esc_html($address['can_receive_truck'] ?? '---');
//             echo '</td></tr>';
//         }
//     } else {
//         echo '<tr><td colspan="2">No addresses saved.</td></tr>';
//     }

//     echo '</table>';
// }
// add_action('show_user_profile', 'show_custom_addresses_in_profile');
// add_action('edit_user_profile', 'show_custom_addresses_in_profile');


add_action('wp_ajax_add_custom_address', 'add_custom_address');
function add_custom_address() {
	if (!is_user_logged_in()) {
		wp_send_json_error('Not logged in');
	}

	$user_id = get_current_user_id();
	$addresses = get_user_meta($user_id, 'custom_addresses', true);
	$addresses = is_array($addresses) ? $addresses : [];

	// Sanitize fields
	$new_address = [
		'address'             => sanitize_text_field($_POST['address'] ?? ''),
		'city'                => sanitize_text_field($_POST['city'] ?? ''),
		'zipcode'             => sanitize_text_field($_POST['zipcode'] ?? ''),
		'country'             => sanitize_text_field($_POST['country'] ?? ''),
		'zone'                => sanitize_text_field($_POST['zone'] ?? ''),
		'storage_facility'    => sanitize_text_field($_POST['storage_facility'] ?? 'No'),
		'liftgate'            => sanitize_text_field($_POST['liftgate'] ?? 'No'),
		'can_receive_truck'   => sanitize_text_field($_POST['can_receive_truck'] ?? 'No'),
	];

	// If editing an existing address
	if (isset($_POST['index']) && $_POST['index'] !== '') {
		$index = intval($_POST['index']);
		if (isset($addresses[$index])) {
			$addresses[$index] = $new_address;
		} else {
			// fallback if index doesn't exist
			$addresses[] = $new_address;
		}
	} else {
		$addresses[] = $new_address;
	}

	update_user_meta($user_id, 'custom_addresses', $addresses);

	wp_send_json_success();
}


?>