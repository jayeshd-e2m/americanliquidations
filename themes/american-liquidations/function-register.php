<?php
// Add this to your functions.php file

// Register custom endpoints for login and register
function custom_login_register_endpoints() {
    add_rewrite_endpoint( 'login', EP_PAGES );
    add_rewrite_endpoint( 'register', EP_PAGES );
}
add_action( 'init', 'custom_login_register_endpoints' );

// Add custom endpoints to WooCommerce query vars
function add_custom_query_vars( $vars ) {
    $vars[] = 'login';
    $vars[] = 'register';
    return $vars;
}
add_filter( 'query_vars', 'add_custom_query_vars' );

// Add custom endpoints to WooCommerce account menu query vars
function add_wc_custom_endpoints( $query_vars ) {
    $query_vars['login'] = 'login';
    $query_vars['register'] = 'register';
    return $query_vars;
}
add_filter( 'woocommerce_get_query_vars', 'add_wc_custom_endpoints' );

// Flush rewrite rules on theme switch
function custom_login_register_flush_rewrite() {
    custom_login_register_endpoints();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'custom_login_register_flush_rewrite' );

// Handle login endpoint content
function custom_login_endpoint_content() {
    // Redirect if user is already logged in
    if ( is_user_logged_in() ) {
        wp_redirect( wc_get_page_permalink( 'myaccount' ) );
        exit;
    }
    wc_get_template( 'myaccount/form-login.php' );
}
add_action( 'woocommerce_account_login_endpoint', 'custom_login_endpoint_content' );

// Handle register endpoint content
function custom_register_endpoint_content() {
    // Redirect if user is already logged in
    if ( is_user_logged_in() ) {
        wp_redirect( wc_get_page_permalink( 'myaccount' ) );
        exit;
    }
    wc_get_template( 'myaccount/form-register.php' );
}
add_action( 'woocommerce_account_register_endpoint', 'custom_register_endpoint_content' );

// Better endpoint detection and content handling
function handle_custom_endpoints() {
    global $wp;
    
    // Check if we're on the my-account page
    if ( ! is_account_page() ) {
        return;
    }
    
    // Check for login endpoint
    if ( isset( $wp->query_vars['login'] ) ) {
        if ( is_user_logged_in() ) {
            wp_redirect( wc_get_page_permalink( 'myaccount' ) );
            exit;
        }
        add_action( 'woocommerce_account_content', function() {
            wc_get_template( 'myaccount/form-login.php' );
        }, 5 );
        return;
    }
    
    // Check for register endpoint
    if ( isset( $wp->query_vars['register'] ) ) {
        if ( is_user_logged_in() ) {
            wp_redirect( wc_get_page_permalink( 'myaccount' ) );
            exit;
        }
        add_action( 'woocommerce_account_content', function() {
            wc_get_template( 'myaccount/form-register.php' );
        }, 5 );
        return;
    }
}
add_action( 'template_redirect', 'handle_custom_endpoints' );

// Handle login form submission on separate login page
function handle_custom_login_form() {
    if ( isset( $_POST['login'] ) && isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
        if ( is_wc_endpoint_url( 'login' ) ) {
            // Let WooCommerce handle the login process
            WC_Form_Handler::process_login();
        }
    }
}
add_action( 'wp_loaded', 'handle_custom_login_form', 20 );

// Handle registration form submission on separate register page
function handle_custom_register_form() {
    if ( isset( $_POST['register'] ) && isset( $_POST['email'] ) ) {
        if ( is_wc_endpoint_url( 'register' ) ) {
            // Let WooCommerce handle the registration process
            WC_Form_Handler::process_registration();
        }
    }
}
add_action( 'wp_loaded', 'handle_custom_register_form', 20 );

// Redirect after successful login
function custom_login_redirect( $redirect, $user ) {
    // Redirect to my-account dashboard after successful login
    return wc_get_page_permalink( 'myaccount' );
}
add_filter( 'woocommerce_login_redirect', 'custom_login_redirect', 10, 2 );

// Redirect after successful registration
function custom_registration_redirect( $redirect ) {
    // Redirect to my-account dashboard after successful registration
    return wc_get_page_permalink( 'myaccount' );
}
add_filter( 'woocommerce_registration_redirect', 'custom_registration_redirect' );












add_action( 'wp_enqueue_scripts', function() {
    // Replace 'your-script-handle' with the ACTUAL handle of your JS file
    wp_localize_script(
        'your-script-handle', 
        'ajax_object', 
        [ 'ajax_url' => admin_url( 'admin-ajax.php' ) ]
    );
});

add_action( 'wp_ajax_nopriv_register_user', 'custom_handle_register_user' );
add_action( 'wp_ajax_register_user', 'custom_handle_register_user' );

function custom_handle_register_user() {
    // Sanitize and validate input
    $full_name   = sanitize_text_field($_POST['full_name']);
    $email       = sanitize_email($_POST['email']);
    $phone       = sanitize_text_field($_POST['phone']);
    $password    = $_POST['password'];
    $is_business = $_POST['is_business']; // checked for "yes" or "no"
    
    // Optional fields for business
    $business_name    = sanitize_text_field($_POST['business_name'] ?? '');
    $business_ein     = sanitize_text_field($_POST['business_ein'] ?? '');
    $business_phone   = sanitize_text_field($_POST['business_phone'] ?? '');
    $business_address = sanitize_textarea_field($_POST['business_address'] ?? '');
    $business_type    = sanitize_text_field($_POST['business_type'] ?? '');

    // Basic checks
    if ( empty($full_name) || empty($email) || empty($phone) || empty($password) ) {
        wp_send_json_error(['message' => 'Required fields are missing.']);
    }
    if ( email_exists($email) ) {
        wp_send_json_error(['message' => 'Email already exists.']);
    }
    
    // Create username (safe, unique)
    $username = sanitize_user(current(explode('@', $email)));
    $suffix = 1;
    while ( username_exists($username) ) {
        $username = sanitize_user(current(explode('@', $email))) . $suffix;
        $suffix++;
    }
    
    // Create WP user
    $user_id = wp_create_user($username, $password, $email);
    if ( is_wp_error($user_id) ) {
        wp_send_json_error(['message' => 'Failed to create user.']);
    }
    
    // (Optional) Split full name
    $full_name_pieces = explode(' ', $full_name, 2);
    $first_name = $full_name_pieces[0];
    $last_name  = $full_name_pieces[1] ?? '';
    
    // Update meta & profile data
    wp_update_user([
        'ID'         => $user_id,
        'first_name' => $first_name,
        'last_name'  => $last_name,
    ]);
    update_user_meta($user_id, 'user_phone', $phone);
    update_user_meta($user_id, 'is_business', $is_business);

    if ( $is_business === 'yes' ) {
        update_user_meta($user_id, 'business_name', $business_name);
        update_user_meta($user_id, 'business_ein', $business_ein);
        update_user_meta($user_id, 'business_phone', $business_phone);
        update_user_meta($user_id, 'business_address', $business_address);
        update_user_meta($user_id, 'business_type', $business_type);
    }

    // Handle file upload if present -- for business only
    if ( $is_business === 'yes' && !empty($_FILES['tax_document']['name']) ) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        $file = &$_FILES['tax_document'];
        $upload = wp_handle_upload($file, ['test_form' => false]);
        if ( !isset($upload['error']) ) {
            update_user_meta($user_id, 'tax_document', $upload['url']);
        }
    }

    // Optionally auto-login user
    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id);

    // Redirect: you can set your own URL here
    $redirect_url = home_url('/dashboard');

    wp_send_json_success([
        'message' => 'User registered!',
        'redirect_url' => $redirect_url,
        'user_id' => $user_id,
    ]);
}
?>